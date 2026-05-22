@extends('user.layouts.app')
@section('title', 'Announcements')
@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-white">Announcements</h1>
    <p class="text-gray-400 mt-1">Pengumuman terbaru dari admin.</p>
</div>

@if ($announcements->count())
    <div class="space-y-6">
        @foreach ($announcements as $a)
            <div class="glass-card p-6">
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                    <span>Posted by <span class="text-blue-400">{{ $a->user?->name }}</span></span>
                    <span>·</span>
                    <span>{{ $a->created_at->format('d M Y H:i') }}</span>
                </div>
                <h2 class="text-lg font-semibold text-white mb-2">{{ $a->title }}</h2>
                <p class="text-gray-400 text-sm leading-relaxed">{!! $a->content !!}</p>
            </div>
        @endforeach
    </div>
    <div class="mt-6">{{ $announcements->links() }}</div>
@else
    <div class="text-center py-16">
        <p class="text-gray-500">Belum ada pengumuman.</p>
    </div>
@endif
@endsection
