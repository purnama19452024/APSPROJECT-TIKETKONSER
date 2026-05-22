@extends('admin.layouts.app')
@section('title', 'Feedbacks')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Feedbacks</h1>
    <p class="text-gray-500 dark:text-gray-400 mt-1">Kritik, saran, dan masukan dari pengguna.</p>
</div>
<div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
    @if ($feedbacks->count())
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-800">
                        <th class="text-left px-4 py-3 font-medium text-gray-500">User</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Type</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Message</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Date</th>
                        <th class="text-right px-4 py-3 font-medium text-gray-500">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach ($feedbacks as $f)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30">
                            <td class="px-4 py-3 text-gray-900 dark:text-white font-medium">{{ $f->user?->name }}</td>
                            <td class="px-4 py-3">
                                <span class="text-xs px-2 py-1 rounded-full font-medium
                                    @if($f->type === 'kritik') bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400
                                    @elseif($f->type === 'saran') bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400
                                    @else bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400 @endif">
                                    {{ ucfirst($f->type) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400 max-w-xs truncate">{{ $f->message }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $f->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.feedbacks.show', $f) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium mr-2">Detail</a>
                                @if (Auth::user()->isAdmin())
                                <form action="{{ route('admin.feedbacks.destroy', $f) }}" method="POST" class="inline" onsubmit="return confirm('Hapus feedback ini?')">
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
        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-800">{{ $feedbacks->links() }}</div>
    @else
        <div class="text-center py-12 text-gray-500"><p>No feedbacks yet.</p></div>
    @endif
</div>
@endsection
