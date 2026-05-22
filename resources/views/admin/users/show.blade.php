@extends('admin.layouts.app')
@section('title', 'User Detail')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 hover:text-blue-700">&larr; Back to Users</a>
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mt-2">User Detail</h1>
</div>

<div class="grid md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
        <div class="flex items-center gap-4 mb-6">
            @if ($user->avatar)
                <img src="{{ Storage::url($user->avatar) }}" alt="" class="w-16 h-16 rounded-full object-cover border-2 border-gray-300 dark:border-gray-600 cursor-pointer hover:opacity-80 transition" onclick="document.getElementById('photoModal').classList.remove('hidden')">
            @else
                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-2xl font-bold">{{ substr($user->name, 0, 1) }}</div>
            @endif
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                <p class="text-sm text-gray-500">{{ $user->email }}</p>
            </div>
        </div>
        <dl class="space-y-3">
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Role</dt>
                <dd>
                    <span class="text-xs px-2 py-1 rounded-full font-medium
                        @if($user->role === 'admin') bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400
                        @elseif($user->role === 'supervisor') bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400
                        @else bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400 @endif">
                        {{ ucfirst($user->role) }}
                    </span>
                </dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Total Bookings</dt>
                <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->bookings_count }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Balance</dt>
                <dd class="text-sm font-semibold {{ $user->balance > 0 ? 'text-green-600 dark:text-green-400' : 'text-gray-900 dark:text-white' }}">Rp {{ number_format($user->balance, 0, ',', '.') }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Joined</dt>
                <dd class="text-sm text-gray-900 dark:text-white">{{ $user->created_at->format('d M Y H:i') }}</dd>
            </div>
        </dl>
        <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-800">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Top Up Balance</h3>
            <form action="{{ route('admin.users.top-up', $user) }}" method="POST" class="flex gap-2">
                @csrf
                <input type="number" name="amount" min="1000" step="500" placeholder="Amount (min 1000)" required class="flex-1 text-sm rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">Top Up</button>
            </form>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Bookings</h2>
        @if ($bookings->count())
            <div class="space-y-3">
                @foreach ($bookings as $booking)
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-800 last:border-0">
                        <div>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->concert?->title ?? 'N/A' }}</span>
                            <span class="text-xs text-gray-500 block">{{ $booking->quantity }} tiket · Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full font-medium
                            @if($booking->status === 'confirmed') bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400
                            @elseif($booking->status === 'cancelled') bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400
                            @else bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400 @endif">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-500">No bookings yet.</p>
        @endif
        </div>
    </div>
</div>

@if ($user->avatar)
<div id="photoModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4" onclick="document.getElementById('photoModal').classList.add('hidden')">
    <div class="relative max-w-lg w-full" onclick="event.stopPropagation()">
        <button onclick="document.getElementById('photoModal').classList.add('hidden')" class="absolute -top-3 -right-3 w-8 h-8 rounded-full bg-gray-800 text-white flex items-center justify-center hover:bg-gray-700 transition z-10">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="w-full rounded-2xl shadow-2xl border border-white/10">
    </div>
</div>
@endif

<script>
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            var m = document.getElementById('photoModal');
            if (m) m.classList.add('hidden');
        }
    });
</script>
@endsection
