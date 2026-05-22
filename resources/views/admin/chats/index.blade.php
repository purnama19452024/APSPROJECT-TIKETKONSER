@extends('admin.layouts.app')
@section('title', 'Chats')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Chats</h1>
    <p class="text-gray-500 dark:text-gray-400 mt-1">Pesan dari pengguna.</p>
</div>
<div class="space-y-4">
    @forelse ($users as $u)
        <a href="{{ route('admin.chats.show', $u) }}" class="flex items-center justify-between bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-5 hover:border-blue-500/50 transition group">
            <div class="flex items-center gap-4">
                @if ($u->avatar)
                    <img src="{{ Storage::url($u->avatar) }}" alt="" class="w-11 h-11 rounded-full object-cover">
                @else
                    <div class="w-11 h-11 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm">{{ substr($u->name, 0, 1) }}</div>
                @endif
                <div>
                    <span class="font-medium text-gray-900 dark:text-white group-hover:text-blue-600 transition">{{ $u->name }}</span>
                    <p class="text-xs text-gray-500">{{ $u->email }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                @if ($u->chats_count > 0)
                    <span class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400 font-semibold">{{ $u->chats_count }} unread</span>
                @endif
                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>
    @empty
        <div class="text-center py-12 text-gray-500"><p>No chats yet.</p></div>
    @endforelse
</div>
@endsection
