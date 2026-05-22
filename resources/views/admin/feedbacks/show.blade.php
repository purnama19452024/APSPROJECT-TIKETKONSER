@extends('admin.layouts.app')
@section('title', 'Feedback Detail')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.feedbacks.index') }}" class="text-sm text-blue-600 hover:text-blue-700">&larr; Back</a>
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mt-2">Feedback Detail</h1>
</div>
<div class="max-w-2xl bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
    <dl class="space-y-4">
        <div class="flex justify-between">
            <dt class="text-sm text-gray-500">User</dt>
            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $feedback->user?->name }} ({{ $feedback->user?->email }})</dd>
        </div>
        <div class="flex justify-between">
            <dt class="text-sm text-gray-500">Type</dt>
            <dd><span class="text-xs px-2 py-1 rounded-full font-medium @if($feedback->type === 'kritik') bg-red-100 text-red-700 @elseif($feedback->type === 'saran') bg-blue-100 text-blue-700 @else bg-gray-100 text-gray-700 @endif">{{ ucfirst($feedback->type) }}</span></dd>
        </div>
        <div class="flex justify-between">
            <dt class="text-sm text-gray-500">Date</dt>
            <dd class="text-sm text-gray-900 dark:text-white">{{ $feedback->created_at->format('d M Y H:i') }}</dd>
        </div>
    </dl>
    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
        <h3 class="text-sm font-medium text-gray-500 mb-2">Message</h3>
        <p class="text-gray-900 dark:text-white whitespace-pre-wrap">{{ $feedback->message }}</p>
    </div>
</div>
@endsection
