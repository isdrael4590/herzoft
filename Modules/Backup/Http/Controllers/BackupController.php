<?php

namespace Modules\Backup\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BackupController extends Controller
{
    /**
     * Display a listing of backups (READ)
     */
    public function index()
    {
        $backups = collect(Storage::disk('backups')->files())
            ->filter(function ($file) {
                return pathinfo($file, PATHINFO_EXTENSION) === 'sql';
            })
            ->map(function ($file) {
                $size = Storage::disk('backups')->size($file);
                $lastModified = Storage::disk('backups')->lastModified($file);
                
                return [
                    'name' => $file,
                    'size' => $size,
                    'size_formatted' => $this->formatBytes($size),
                    'last_modified' => $lastModified,
                    'date' => date('Y-m-d H:i:s', $lastModified),
                    'date_human' => $this->timeAgo($lastModified),
                ];
            })
            ->sortByDesc('last_modified')
            ->values();

        return view('backup::index', compact('backups'));
    }

    /**
     * Store a newly created backup (CREATE)
     */
    public function store(Request $request)
    {
        try {
            $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
            
            $this->createDatabaseBackup($filename);

            // Verificar que el archivo se creó correctamente
            if (!Storage::disk('backups')->exists($filename)) {
                throw new \Exception('El archivo de backup no se creó');
            }

            // Verificar que el archivo no está vacío
            if (Storage::disk('backups')->size($filename) < 100) {
                Storage::disk('backups')->delete($filename);
                throw new \Exception('El archivo de backup está vacío o corrupto');
            }

            return response()->json([
                'success' => true,
                'message' => 'Backup creado exitosamente: ' . $filename,
                'filename' => $filename
            ]);
        } catch (\Exception $e) {
            Log::error('Error creando backup: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al crear backup: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Download a backup file
     */
    public function download($backup)
    {
        if (!Storage::disk('backups')->exists($backup)) {
            abort(404, 'Backup no encontrado');
        }

        return Storage::disk('backups')->download($backup);
    }

    /**
     * Upload a backup file
     */
    public function upload(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file|mimes:sql,zip|max:102400', // 100MB max
        ]);

        try {
            $file = $request->file('backup_file');
            $filename = 'uploaded_' . time() . '_' . $file->getClientOriginalName();

            $file->storeAs('', $filename, 'backups');

            return response()->json([
                'success' => true,
                'message' => 'Backup subido exitosamente: ' . $filename
            ]);
        } catch (\Exception $e) {
            Log::error('Error subiendo backup: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al subir backup: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Restore database from backup
     */
    public function restore($backup)
    {
        if (!Storage::disk('backups')->exists($backup)) {
            return response()->json([
                'success' => false,
                'message' => 'Backup no encontrado'
            ], 404);
        }

        try {
            $this->restoreFromBackup($backup);

            return response()->json([
                'success' => true,
                'message' => 'Base de datos restaurada exitosamente desde: ' . $backup
            ]);
        } catch (\Exception $e) {
            Log::error('Error restaurando backup: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al restaurar backup: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified backup (DELETE)
     */
    public function destroy($backup)
    {
        if (!Storage::disk('backups')->exists($backup)) {
            return response()->json([
                'success' => false,
                'message' => 'Backup no encontrado'
            ], 404);
        }

        try {
            Storage::disk('backups')->delete($backup);

            return response()->json([
                'success' => true,
                'message' => 'Backup eliminado exitosamente'
            ]);
        } catch (\Exception $e) {
            Log::error('Error eliminando backup: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar backup: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create database backup using mysqldump
     */
    private function createDatabaseBackup($filename)
    {
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');
        $port = config('database.connections.mysql.port', 3306);

        $backupPath = Storage::disk('backups')->path($filename);

        // Verificar conexión a la base de datos primero
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            throw new \Exception('No se puede conectar a la base de datos. Verifica que MySQL esté corriendo: ' . $e->getMessage());
        }

        // Detectar si estamos usando Docker
        $isDocker = file_exists('/.dockerenv') || getenv('DOCKER_ENVIRONMENT');

        if ($isDocker) {
            // Si estamos en Docker, usar conexión directa
            return $this->createBackupWithPDO($filename);
        }

        // Crear archivo temporal para la contraseña (más seguro)
        $configFile = tempnam(sys_get_temp_dir(), 'mysql_');
        file_put_contents($configFile, "[client]\npassword=\"{$password}\"\n");

        try {
            // Comando mejorado con opciones adicionales
            $command = sprintf(
                'mysqldump --defaults-extra-file=%s --user=%s --host=%s --port=%d --single-transaction --routines --triggers --events --set-gtid-purged=OFF %s > %s 2>&1',
                escapeshellarg($configFile),
                escapeshellarg($username),
                escapeshellarg($host),
                $port,
                escapeshellarg($database),
                escapeshellarg($backupPath)
            );

            $output = [];
            $returnVar = 0;
            exec($command, $output, $returnVar);

            // Limpiar archivo temporal
            @unlink($configFile);

            if ($returnVar !== 0) {
                $errorMessage = implode("\n", $output);
                Log::error('Error mysqldump: ' . $errorMessage);
                
                // Si falla mysqldump, intentar con PDO
                Log::info('Intentando backup con PDO...');
                return $this->createBackupWithPDO($filename);
            }

            // Verificar que el archivo se creó y tiene contenido
            if (!file_exists($backupPath)) {
                throw new \Exception('El archivo de backup no se generó');
            }

            if (filesize($backupPath) < 100) {
                throw new \Exception('El archivo de backup está vacío o es muy pequeño');
            }

        } catch (\Exception $e) {
            // Limpiar archivo temporal si existe
            @unlink($configFile);
            
            // Eliminar archivo de backup si se creó incompleto
            if (file_exists($backupPath)) {
                @unlink($backupPath);
            }
            
            throw $e;
        }
    }

    /**
     * Create backup using PDO (fallback method)
     */
    private function createBackupWithPDO($filename)
    {
        $database = config('database.connections.mysql.database');
        $backupPath = Storage::disk('backups')->path($filename);

        try {
            $pdo = DB::connection()->getPdo();
            
            // Obtener todas las tablas
            $tables = DB::select('SHOW TABLES');
            $tableKey = 'Tables_in_' . $database;
            
            $sql = "-- MySQL Database Backup\n";
            $sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n\n";
            $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

            foreach ($tables as $table) {
                $tableName = $table->$tableKey;
                
                // Estructura de la tabla
                $createTable = DB::select("SHOW CREATE TABLE `{$tableName}`");
                $sql .= "-- Table: {$tableName}\n";
                $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
                $sql .= $createTable[0]->{'Create Table'} . ";\n\n";
                
                // Datos de la tabla
                $rows = DB::table($tableName)->get();
                
                if ($rows->count() > 0) {
                    $sql .= "-- Data for table {$tableName}\n";
                    
                    foreach ($rows as $row) {
                        $values = array_map(function($value) use ($pdo) {
                            return $value === null ? 'NULL' : $pdo->quote($value);
                        }, (array)$row);
                        
                        $sql .= "INSERT INTO `{$tableName}` VALUES (" . implode(', ', $values) . ");\n";
                    }
                    
                    $sql .= "\n";
                }
            }

            $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

            // Guardar el archivo
            file_put_contents($backupPath, $sql);

            if (filesize($backupPath) < 100) {
                throw new \Exception('El archivo de backup generado está vacío');
            }

            Log::info('Backup creado exitosamente usando PDO: ' . $filename);

        } catch (\Exception $e) {
            if (file_exists($backupPath)) {
                @unlink($backupPath);
            }
            throw new \Exception('Error al crear backup con PDO: ' . $e->getMessage());
        }
    }

    /**
     * Restore database from backup using mysql
     */
    private function restoreFromBackup($filename)
    {
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');
        $port = config('database.connections.mysql.port', 3306);

        $backupPath = Storage::disk('backups')->path($filename);

        // Verificar que el archivo existe y es legible
        if (!file_exists($backupPath) || !is_readable($backupPath)) {
            throw new \Exception('El archivo de backup no existe o no es legible');
        }

        // Crear archivo temporal para la contraseña
        $configFile = tempnam(sys_get_temp_dir(), 'mysql_');
        file_put_contents($configFile, "[client]\npassword=\"{$password}\"\n");

        try {
            $command = sprintf(
                'mysql --defaults-extra-file=%s --user=%s --host=%s --port=%d %s < %s 2>&1',
                escapeshellarg($configFile),
                escapeshellarg($username),
                escapeshellarg($host),
                $port,
                escapeshellarg($database),
                escapeshellarg($backupPath)
            );

            $output = [];
            $returnVar = 0;
            exec($command, $output, $returnVar);

            // Limpiar archivo temporal
            @unlink($configFile);

            if ($returnVar !== 0) {
                $errorMessage = implode("\n", $output);
                Log::error('Error mysql restore: ' . $errorMessage);
                throw new \Exception('Error al restaurar la base de datos: ' . $errorMessage);
            }

        } catch (\Exception $e) {
            @unlink($configFile);
            throw $e;
        }
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }

    /**
     * Convert timestamp to human readable time ago
     */
    private function timeAgo($timestamp)
    {
        $diff = time() - $timestamp;

        if ($diff < 60) {
            return 'Hace ' . $diff . ' segundos';
        } elseif ($diff < 3600) {
            return 'Hace ' . floor($diff / 60) . ' minutos';
        } elseif ($diff < 86400) {
            return 'Hace ' . floor($diff / 3600) . ' horas';
        } elseif ($diff < 604800) {
            return 'Hace ' . floor($diff / 86400) . ' días';
        } else {
            return date('d/m/Y H:i', $timestamp);
        }
    }
}