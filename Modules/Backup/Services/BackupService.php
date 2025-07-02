<?php

namespace Modules\Backup\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;

class BackupService
{
    protected $backupDisk;
    protected $backupPath;

    public function __construct()
    {
        $this->backupDisk = Storage::disk('local');
        $this->backupPath = 'modules/backup/files';
        
        // Crear directorio si no existe
        if (!$this->backupDisk->exists($this->backupPath)) {
            $this->backupDisk->makeDirectory($this->backupPath);
        }
    }

    /**
     * Get list of all backups
     */
    public function getBackupsList(): \Illuminate\Support\Collection
    {
        return collect($this->backupDisk->files($this->backupPath))
            ->filter(function ($file) {
                return in_array(pathinfo($file, PATHINFO_EXTENSION), ['sql', 'zip']);
            })
            ->map(function ($file) {
                return [
                    'name' => basename($file),
                    'path' => $file,
                    'size' => $this->backupDisk->size($file),
                    'size_formatted' => $this->formatBytes($this->backupDisk->size($file)),
                    'date' => Carbon::createFromTimestamp($this->backupDisk->lastModified($file))->format('Y-m-d H:i:s'),
                    'date_human' => Carbon::createFromTimestamp($this->backupDisk->lastModified($file))->diffForHumans()
                ];
            })
            ->sortByDesc('date')
            ->values();
    }

    /**
     * Create a new database backup
     */
    public function createBackup(): array
    {
        try {
            $databaseName = config('database.connections.mysql.database');
            $username = config('database.connections.mysql.username');
            $password = config('database.connections.mysql.password');
            $host = config('database.connections.mysql.host');
            $port = config('database.connections.mysql.port', 3306);

            // Nombre del archivo de backup
            $filename = 'backup_' . $databaseName . '_' . date('Y-m-d_H-i-s') . '.sql';
            $fullPath = storage_path('app/' . $this->backupPath . '/' . $filename);

            // Asegurar que el directorio existe
            $directory = dirname($fullPath);
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            // Comando mysqldump
            $command = sprintf(
                'mysqldump -h%s -P%s -u%s -p%s --routines --triggers --single-transaction %s > %s',
                escapeshellarg($host),
                escapeshellarg($port),
                escapeshellarg($username),
                escapeshellarg($password),
                escapeshellarg($databaseName),
                escapeshellarg($fullPath)
            );

            // Ejecutar el comando
            exec($command . ' 2>&1', $output, $returnVar);

            if ($returnVar === 0 && file_exists($fullPath) && filesize($fullPath) > 0) {
                return [
                    'success' => true,
                    'message' => 'Backup creado exitosamente',
                    'filename' => $filename
                ];
            } else {
                // Limpiar archivo si existe pero está vacío
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
                
                return [
                    'success' => false,
                    'message' => 'Error al crear el backup: ' . implode('\n', $output)
                ];
            }

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error al crear backup: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Download a backup file
     */
    public function downloadBackup(string $filename)
    {
        $filepath = $this->backupPath . '/' . $filename;
        
        if (!$this->backupDisk->exists($filepath)) {
            throw new \Exception('Archivo no encontrado');
        }

        return $this->backupDisk->download($filepath);
    }

    /**
     * Upload a backup file
     */
    public function uploadBackup(UploadedFile $file): array
    {
        try {
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = 'uploaded_' . $originalName . '_' . date('Y-m-d_H-i-s') . '.' . $extension;
            
            // Guardar el archivo
            $file->storeAs($this->backupPath, $filename, 'local');

            return [
                'success' => true,
                'message' => 'Backup subido exitosamente',
                'filename' => $filename
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error al subir archivo: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Restore database from backup
     */
    public function restoreBackup(string $filename): array
    {
        try {
            $filepath = storage_path('app/' . $this->backupPath . '/' . $filename);

            if (!file_exists($filepath)) {
                return [
                    'success' => false,
                    'message' => 'Archivo de backup no encontrado'
                ];
            }

            $databaseName = config('database.connections.mysql.database');
            $username = config('database.connections.mysql.username');
            $password = config('database.connections.mysql.password');
            $host = config('database.connections.mysql.host');
            $port = config('database.connections.mysql.port', 3306);

            // Comando mysql para restaurar
            $command = sprintf(
                'mysql -h%s -P%s -u%s -p%s %s < %s',
                escapeshellarg($host),
                escapeshellarg($port),
                escapeshellarg($username),
                escapeshellarg($password),
                escapeshellarg($databaseName),
                escapeshellarg($filepath)
            );

            exec($command . ' 2>&1', $output, $returnVar);

            if ($returnVar === 0) {
                return [
                    'success' => true,
                    'message' => 'Base de datos restaurada exitosamente'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Error al restaurar la base de datos: ' . implode('\n', $output)
                ];
            }

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error al restaurar: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Delete a backup file
     */
    public function deleteBackup(string $filename): array
    {
        try {
            $filepath = $this->backupPath . '/' . $filename;
            
            if (!$this->backupDisk->exists($filepath)) {
                return [
                    'success' => false,
                    'message' => 'Archivo no encontrado'
                ];
            }

            $this->backupDisk->delete($filepath);

            return [
                'success' => true,
                'message' => 'Backup eliminado exitosamente'
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error al eliminar: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}