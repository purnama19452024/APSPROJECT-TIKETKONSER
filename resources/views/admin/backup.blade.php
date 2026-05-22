@extends('admin.layouts.app')
@section('title', 'Backup & Restore')
@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Backup & Restore</h1>
    <p class="text-gray-500 dark:text-gray-400 mt-1">Kelola backup database dan file upload.</p>
</div>

@if (Auth::user()->isAdmin())
<div class="grid md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Create Backup</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Backup akan menyimpan database SQLite dan seluruh file upload (gambar, bukti bayar, avatar) ke dalam file ZIP.</p>
        <form method="POST" action="{{ route('admin.backup.create') }}">
            @csrf
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Create Backup Now
            </button>
        </form>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Restore Backup</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Upload file backup ZIP untuk mengembalikan database dan file ke kondisi backup.</p>
        <form method="POST" action="{{ route('admin.backup.restore') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <input type="file" name="backup_file" accept=".zip" required
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 dark:file:bg-blue-900/30 dark:file:text-blue-400 transition cursor-pointer">
                @error('backup_file') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg text-sm font-semibold text-white bg-amber-600 hover:bg-amber-700 transition" onclick="return confirm('Restore akan menimpa data saat ini. Lanjutkan?')">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Restore Backup
            </button>
        </form>
    </div>
</div>
@endif

@if ($backups->count())
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Saved Backups</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-800">
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Filename</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Size</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Created</th>
                        <th class="text-right px-4 py-3 font-medium text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach ($backups as $backup)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30">
                            <td class="px-4 py-3 font-mono text-sm text-gray-900 dark:text-white">{{ $backup['name'] }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $backup['size'] }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $backup['date'] }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.backup.download', $backup['name']) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium mr-3">Download</a>
                                @if (Auth::user()->isAdmin())
                                <form action="{{ route('admin.backup.destroy', $backup['name']) }}" method="POST" class="inline" onsubmit="return confirm('Hapus backup ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600 text-sm font-medium">Delete</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-8 text-center">
        <p class="text-gray-500">Belum ada backup. Buat backup pertama Anda.</p>
    </div>
@endif
@endsection
