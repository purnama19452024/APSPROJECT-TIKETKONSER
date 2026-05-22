@extends('admin.layouts.app')
@section('title', 'Announcements')
@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Announcements</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1">Manage announcements for users.</p>
    </div>
    @if (Auth::user()->isAdmin())
    <a href="{{ route('admin.announcements.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Announcement
    </a>
    @endif
</div>

<div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
    @if ($announcements->count())
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-800">
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Title</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Status</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">By</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Date</th>
                        <th class="text-right px-4 py-3 font-medium text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach ($announcements as $a)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30">
                            <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $a->title }}</td>
                            <td class="px-4 py-3">
                                <span class="text-xs px-2 py-1 rounded-full font-medium {{ $a->status === 'active' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-500 dark:bg-gray-800' }}">
                                    {{ ucfirst($a->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $a->user?->name }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $a->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-right">
                                @if (Auth::user()->isAdmin())
                                <a href="{{ route('admin.announcements.edit', $a) }}" class="text-amber-600 hover:text-amber-700 text-sm font-medium mr-2">Edit</a>
                                <form action="{{ route('admin.announcements.destroy', $a) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pengumuman ini?')">
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
        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-800">{{ $announcements->links() }}</div>
    @else
        <div class="text-center py-12 text-gray-500"><p>No announcements yet.</p></div>
    @endif
</div>
@endsection
