<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use ZipArchive;

class BackupController extends Controller
{
    private string $backupDir;

    public function __construct()
    {
        $this->backupDir = storage_path('app/backups');
    }

    public function index(): View
    {
        $backups = collect();

        if (is_dir($this->backupDir)) {
            $files = File::files($this->backupDir);
            $backups = collect($files)
                ->filter(fn ($f) => $f->getExtension() === 'zip')
                ->map(fn ($f) => [
                    'name' => $f->getFilename(),
                    'size' => $this->formatSize($f->getSize()),
                    'date' => date('d M Y H:i:s', $f->getMTime()),
                    'path' => $f->getRealPath(),
                ])
                ->sortByDesc('date')
                ->values();
        }

        return view('admin.backup', compact('backups'));
    }

    public function create()
    {
        if (! is_dir($this->backupDir)) {
            mkdir($this->backupDir, 0755, true);
        }

        $timestamp = now()->format('Y-m-d_H-i-s');
        $filename = "backup_{$timestamp}.zip";
        $filepath = "{$this->backupDir}/{$filename}";

        $zip = new ZipArchive;

        if ($zip->open($filepath, ZipArchive::CREATE) !== true) {
            return back()->withErrors(['error' => 'Gagal membuat file backup.']);
        }

        $dbPath = database_path('sqlite/database.sqlite');
        if (file_exists($dbPath)) {
            $zip->addFile($dbPath, 'database/sqlite/database.sqlite');
        }

        $storagePath = storage_path('app/public');
        if (is_dir($storagePath)) {
            $files = File::allFiles($storagePath);
            foreach ($files as $file) {
                $relativePath = 'storage/app/public/'.$file->getRelativePathname();
                $zip->addFile($file->getRealPath(), $relativePath);
            }
        }

        $zip->close();

        return back()->with('success', "Backup berhasil dibuat: {$filename}");
    }

    public function restore(Request $request): RedirectResponse
    {
        $request->validate([
            'backup_file' => 'required|file|mimes:zip|max:204800',
        ]);

        $zip = new ZipArchive;
        $uploaded = $request->file('backup_file');
        $tempPath = $uploaded->path();

        if ($zip->open($tempPath) !== true) {
            return back()->withErrors(['error' => 'Gagal membuka file backup.']);
        }

        $extractPath = storage_path('app/restore_temp');
        if (is_dir($extractPath)) {
            File::deleteDirectory($extractPath);
        }
        mkdir($extractPath, 0755, true);

        $zip->extractTo($extractPath);
        $zip->close();

        $dbSource = $extractPath.'/database/sqlite/database.sqlite';
        if (file_exists($dbSource)) {
            $dbTarget = database_path('sqlite/database.sqlite');
            copy($dbSource, $dbTarget);
        }

        $storageSource = $extractPath.'/storage/app/public';
        if (is_dir($storageSource)) {
            $storageTarget = storage_path('app/public');
            File::copyDirectory($storageSource, $storageTarget);
        }

        File::deleteDirectory($extractPath);

        return back()->with('success', 'Restore berhasil! Database dan file telah dikembalikan.');
    }

    public function download(string $filename)
    {
        $filepath = "{$this->backupDir}/{$filename}";

        if (! file_exists($filepath)) {
            return back()->withErrors(['error' => 'File backup tidak ditemukan.']);
        }

        return response()->download($filepath);
    }

    public function destroy(string $filename): RedirectResponse
    {
        $filepath = "{$this->backupDir}/{$filename}";

        if (file_exists($filepath)) {
            unlink($filepath);
        }

        return back()->with('success', "Backup {$filename} berhasil dihapus.");
    }

    private function formatSize(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 2).' '.$units[$i];
    }
}
