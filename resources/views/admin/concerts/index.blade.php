@extends('admin.layouts.app')
@section('title', 'Manage Concerts')
@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Concerts</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1">Manage all concert events.</p>
    </div>
    <a href="{{ route('admin.concerts.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Concert
    </a>
</div>

<div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
    @if ($concerts->count())
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-800">
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Poster</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Title</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Artist</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Date</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Venue</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Price</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Ticket Expiry</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Seats</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Status</th>
                        <th class="text-right px-4 py-3 font-medium text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach ($concerts as $concert)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30">
                            <td class="px-4 py-3">
                                @if ($concert->image)
                                    <img src="{{ Storage::url($concert->image) }}" alt="" class="w-14 h-10 object-cover rounded-lg">
                                @else
                                    <div class="w-14 h-10 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $concert->title }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $concert->artist }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $concert->date->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $concert->venue }}, {{ $concert->city }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">Rp {{ number_format($concert->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                @if ($concert->ticket_expiry)
                                    <span class="text-xs {{ now()->greaterThan($concert->ticket_expiry) ? 'text-red-500 dark:text-red-400' : 'text-gray-600 dark:text-gray-400' }}">
                                        {{ $concert->ticket_expiry->format('d M Y H:i') }}
                                    </span>
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $concert->available_seats }}</td>
                            <td class="px-4 py-3">
                                <span class="text-xs px-2 py-1 rounded-full font-medium {{ $concert->status === 'active' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-500 dark:bg-gray-800' }}">
                                    {{ ucfirst($concert->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.concerts.edit', $concert) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium mr-3">Edit</a>
                                <form action="{{ route('admin.concerts.destroy', $concert) }}" method="POST" class="inline" onsubmit="return confirm('Delete this concert?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600 text-sm font-medium">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-800">
            {{ $concerts->links() }}
        </div>
    @else
        <div class="text-center py-12 text-gray-500">
            <p>No concerts yet. Create your first concert!</p>
        </div>
    @endif
</div>
@endsection
