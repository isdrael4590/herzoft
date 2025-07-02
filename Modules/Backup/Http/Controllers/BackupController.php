<?php

namespace Modules\Backup\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
                return [
                    'name' => $file,
                    'size' => Storage::disk('backups')->size($file),
                    'last_modified' => Storage::disk('backups')->lastModified($file),
                ];
            })
            ->sortByDesc('last_modified');

        return view('backup::index', compact('backups'));
    }

    /**
     * Show the form for creating a new backup (CREATE)
     */
    public function create()
    {
        return view('backup::create');
    }

    /**
     * Store a newly created backup (CREATE)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $filename = $request->name . '_' . date('Y-m-d_H-i-s') . '.sql';

        try {
            $this->createDatabaseBackup($filename);

            return redirect()->route('backups.index')
                ->with('success', 'Backup created successfully: ' . $filename);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to create backup: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified backup (READ)
     */
    public function show($backup)
    {
        if (!Storage::disk('backups')->exists($backup)) {
            abort(404, 'Backup not found');
        }

        $backupInfo = [
            'name' => $backup,
            'size' => Storage::disk('backups')->size($backup),
            'last_modified' => Storage::disk('backups')->lastModified($backup),
            'path' => Storage::disk('backups')->path($backup),
        ];

        return view('backups.show', compact('backupInfo'));
    }

    /**
     * Show the form for editing the specified backup (UPDATE)
     */
    public function edit($backup)
    {
        if (!Storage::disk('backups')->exists($backup)) {
            abort(404, 'Backup not found');
        }

        return view('backups.edit', compact('backup'));
    }

    /**
     * Update the specified backup (UPDATE)
     * Note: For backups, this might just rename the file
     */
    public function update(Request $request, $backup)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if (!Storage::disk('backups')->exists($backup)) {
            abort(404, 'Backup not found');
        }

        $newName = $request->name . '.' . pathinfo($backup, PATHINFO_EXTENSION);

        try {
            Storage::disk('backups')->move($backup, $newName);

            return redirect()->route('backups.index')
                ->with('success', 'Backup renamed successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to rename backup: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified backup (DELETE)
     */
    public function destroy($backup)
    {
        if (!Storage::disk('backups')->exists($backup)) {
            abort(404, 'Backup not found');
        }

        try {
            Storage::disk('backups')->delete($backup);

            return redirect()->route('backups.index')
                ->with('success', 'Backup deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete backup: ' . $e->getMessage());
        }
    }

    /**
     * Download a backup file
     */
    public function download($backup)
    {
        if (!Storage::disk('backups')->exists($backup)) {
            abort(404, 'Backup not found');
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
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('', $filename, 'backups');

            return redirect()->route('backups.index')
                ->with('success', 'Backup uploaded successfully: ' . $filename);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to upload backup: ' . $e->getMessage());
        }
    }

    /**
     * Restore database from backup
     */
    public function restore($backup)
    {
        if (!Storage::disk('backups')->exists($backup)) {
            abort(404, 'Backup not found');
        }

        try {
            $this->restoreFromBackup($backup);

            return redirect()->route('backups.index')
                ->with('success', 'Database restored successfully from: ' . $backup);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to restore backup: ' . $e->getMessage());
        }
    }

    /**
     * Create database backup
     */
    private function createDatabaseBackup($filename)
    {
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');

        $backupPath = Storage::disk('backups')->path($filename);

        $command = "mysqldump --user={$username} --password={$password} --host={$host} {$database} > {$backupPath}";

        $result = null;
        $output = null;
        exec($command, $output, $result);

        if ($result !== 0) {
            throw new \Exception('Failed to create database backup');
        }
    }

    /**
     * Restore database from backup
     */
    private function restoreFromBackup($filename)
    {
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');

        $backupPath = Storage::disk('backups')->path($filename);

        $command = "mysql --user={$username} --password={$password} --host={$host} {$database} < {$backupPath}";

        $result = null;
        $output = null;
        exec($command, $output, $result);

        if ($result !== 0) {
            throw new \Exception('Failed to restore database from backup');
        }
    }
}
