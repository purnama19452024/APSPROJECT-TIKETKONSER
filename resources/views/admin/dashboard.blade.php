@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
    <p class="text-gray-500 dark:text-gray-400 mt-1">Welcome, <span class="capitalize text-blue-400">{{ $user->role }}</span> — {{ $user->name }}.</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-medium text-gray-500">Total Concerts</span>
            <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"/></svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalConcerts }}</div>
        <div class="text-sm text-gray-500 mt-1">{{ $activeConcerts }} active</div>
    </div>
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-medium text-gray-500">Total Bookings</span>
            <div class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalBookings }}</div>
        <div class="text-sm text-gray-500 mt-1">Total bookings</div>
    </div>
    <a href="{{ route('admin.invoices.index', ['type' => 'incoming']) }}" class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6 hover:border-green-500/50 transition group">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-medium text-gray-500">Uang Masuk</span>
            <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 group-hover:scale-110 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125V9M7.5 12h.75M12 12h.75M16.5 12h.75m0 0a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75h.75zm-3.75 0a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75h.75zm-3.75 0a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75h.75z"/></svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-green-600 dark:text-green-400">Rp {{ number_format($moneyIn, 0, ',', '.') }}</div>
        <div class="text-sm text-gray-500 mt-1">Top-up + ticket payments</div>
    </a>
    <a href="{{ route('admin.invoices.index', ['type' => 'outgoing']) }}" class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6 hover:border-red-500/50 transition group">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-medium text-gray-500">Uang Keluar</span>
            <div class="w-10 h-10 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-red-600 group-hover:scale-110 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125V9M7.5 12h.75M12 12h.75M16.5 12h.75m0 0a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75h.75zm-3.75 0a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75h.75zm-3.75 0a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75h.75z"/></svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-red-600 dark:text-red-400">Rp {{ number_format($moneyOut, 0, ',', '.') }}</div>
        <div class="text-sm text-gray-500 mt-1">Withdrawals</div>
    </a>
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-medium text-gray-500">Total Revenue</span>
            <div class="w-10 h-10 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        <div class="text-sm text-gray-500 mt-1">Net (in - out)</div>
    </div>
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-medium text-gray-500">Total Users</span>
            <div class="w-10 h-10 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center text-amber-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalUsers }}</div>
        <div class="text-sm text-gray-500 mt-1">Registered users</div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <a href="{{ route('admin.concerts.create') }}" class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6 hover:border-blue-500/50 transition group">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 group-hover:scale-110 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/></svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">Add Ticket</h3>
                <p class="text-sm text-gray-500">Create new concert schedule</p>
            </div>
        </div>
    </a>
    @if (Auth::user()->isAdmin())
    <a href="{{ route('admin.users.create') }}" class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6 hover:border-purple-500/50 transition group">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 group-hover:scale-110 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">Add User</h3>
                <p class="text-sm text-gray-500">Register new user account</p>
            </div>
        </div>
    </a>
    <a href="{{ route('admin.users.create') }}?role=supervisor" class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6 hover:border-amber-500/50 transition group">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center text-amber-600 group-hover:scale-110 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">Add Supervisor</h3>
                <p class="text-sm text-gray-500">Create supervisor account</p>
            </div>
        </div>
    </a>
    @endif
</div>

<div class="grid lg:grid-cols-2 gap-6">
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Bookings</h2>
        @if ($recentBookings->count())
            <div class="space-y-3">
                @foreach ($recentBookings as $booking)
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-800 last:border-0">
                        <div>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->concert?->title ?? 'N/A' }}</span>
                            <span class="text-xs text-gray-500 block">{{ $booking->user?->name }} · {{ $booking->quantity }} tiket</span>
                        </div>
                            <span class="text-xs px-2 py-1 rounded-full font-medium
                                    @if($booking->status === 'confirmed') bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400
                                    @elseif($booking->status === 'cancelled') bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400
                                    @elseif($booking->status === 'expired') bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400
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
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Upcoming Concerts</h2>
        @if ($upcomingConcerts->count())
            <div class="space-y-3">
                @foreach ($upcomingConcerts as $concert)
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-800 last:border-0">
                        <div>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $concert->title }}</span>
                            <span class="text-xs text-gray-500 block">{{ $concert->date->format('d M Y') }} · {{ $concert->venue }}</span>
                        </div>
                        <span class="text-xs font-semibold text-blue-600">{{ $concert->available_seats }} seats</span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-500">No upcoming concerts.</p>
        @endif
    </div>
</div>
@endsection
