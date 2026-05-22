@extends('user.layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-white">Dashboard</h1>
    <p class="text-gray-400 mt-1">Welcome back, <span class="text-blue-400">{{ Auth::user()->name }}</span>!</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="glass-card p-6">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-medium text-gray-400">Total Tickets</span>
            <div class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-white">{{ $totalBookings }}</div>
        <div class="text-sm text-gray-500 mt-1">All time bookings</div>
    </div>
    <div class="glass-card p-6">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-medium text-gray-400">Confirmed</span>
            <div class="w-10 h-10 rounded-lg bg-green-500/10 flex items-center justify-center text-green-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-white">{{ $confirmedBookings }}</div>
        <div class="text-sm text-gray-500 mt-1">Confirmed tickets</div>
    </div>
    <div class="glass-card p-6">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-medium text-gray-400">Total Spent</span>
            <div class="w-10 h-10 rounded-lg bg-purple-500/10 flex items-center justify-center text-purple-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-white">Rp {{ number_format($totalSpent, 0, ',', '.') }}</div>
        <div class="text-sm text-gray-500 mt-1">Total spent</div>
    </div>
    <div class="glass-card p-6" style="border-color: rgba(0, 212, 255, 0.25);">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-medium text-gray-400">Saldo</span>
            <div class="w-10 h-10 rounded-lg bg-cyan-500/10 flex items-center justify-center text-cyan-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-white">Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}</div>
        <div class="text-sm text-gray-500 mt-1">Current balance</div>
    </div>
</div>

<div class="glass-card p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-white">Your Tickets</h2>
        <a href="{{ route('concerts.index') }}" class="text-sm text-blue-400 hover:text-blue-300 transition">Browse Concerts</a>
    </div>
    @if ($bookings->count())
        <div class="space-y-4">
            @foreach ($bookings as $booking)
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-4 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 transition">
                    <div class="flex items-center gap-4">
                        @if ($booking->concert->image)
                            <img src="{{ Storage::url($booking->concert->image) }}" alt="" class="w-16 h-12 rounded-lg object-cover">
                        @else
                            <div class="w-16 h-12 rounded-lg bg-gray-800 flex items-center justify-center text-gray-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"/></svg>
                            </div>
                        @endif
                        <div>
                            <h3 class="text-white font-semibold text-sm">{{ $booking->concert->title }}</h3>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $booking->concert->date->format('d M Y') }} · {{ $booking->concert->venue }}</p>
                            <div class="flex items-center gap-3 mt-1 text-xs text-gray-500">
                                <span>{{ $booking->quantity }} ticket(s)</span>
                                <span class="neon-text font-semibold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <span class="text-xs px-3 py-1 rounded-full font-medium
                            @if($booking->status === 'confirmed') bg-green-500/10 text-green-400 border border-green-500/20
                            @elseif($booking->status === 'cancelled') bg-red-500/10 text-red-400 border border-red-500/20
                            @else bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 @endif">
                            {{ ucfirst($booking->status) }}
                        </span>
                        <a href="{{ route('bookings.show', $booking) }}" class="text-xs text-blue-400 hover:text-blue-300 transition">Detail</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-gray-500 mb-4">You haven't booked any tickets yet.</p>
            <a href="{{ route('concerts.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300">
                Browse Concerts
            </a>
        </div>
    @endif
</div>
@endsection
