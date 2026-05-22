@extends('user.layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">Welcome back, <span class="neon-text">{{ Auth::user()->name }}</span>!</h1>
            <p class="text-gray-500 mt-1">Here's your ticket overview and upcoming schedule.</p>
        </div>
        <a href="{{ route('concerts.index') }}" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300 shadow-lg shadow-blue-500/25">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Browse Concerts
        </a>
    </div>
</div>

<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="glass-card p-5 relative overflow-hidden group hover:border-blue-500/30 transition-all duration-300">
        <div class="absolute -top-6 -right-6 w-16 h-16 bg-blue-500/5 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-medium tracking-wider text-gray-500 uppercase">Total Tickets</span>
            <div class="w-9 h-9 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-white">{{ $totalBookings }}</div>
        <div class="text-xs text-gray-500 mt-1">All time bookings</div>
    </div>
    <div class="glass-card p-5 relative overflow-hidden group hover:border-green-500/30 transition-all duration-300">
        <div class="absolute -top-6 -right-6 w-16 h-16 bg-green-500/5 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-medium tracking-wider text-gray-500 uppercase">Confirmed</span>
            <div class="w-9 h-9 rounded-lg bg-green-500/10 flex items-center justify-center text-green-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-white">{{ $confirmedBookings }}</div>
        <div class="text-xs text-gray-500 mt-1">Confirmed tickets</div>
    </div>
    <div class="glass-card p-5 relative overflow-hidden group hover:border-purple-500/30 transition-all duration-300">
        <div class="absolute -top-6 -right-6 w-16 h-16 bg-purple-500/5 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-medium tracking-wider text-gray-500 uppercase">Total Spent</span>
            <div class="w-9 h-9 rounded-lg bg-purple-500/10 flex items-center justify-center text-purple-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-white">Rp {{ number_format($totalSpent, 0, ',', '.') }}</div>
        <div class="text-xs text-gray-500 mt-1">Total spent</div>
    </div>
    <div class="glass-card p-5 relative overflow-hidden group hover:border-cyan-500/30 transition-all duration-300" style="border-color: rgba(0, 212, 255, 0.25);">
        <div class="absolute -top-6 -right-6 w-16 h-16 bg-cyan-500/5 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-medium tracking-wider text-gray-500 uppercase">Saldo</span>
            <div class="w-9 h-9 rounded-lg bg-cyan-500/10 flex items-center justify-center text-cyan-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125V9M7.5 12h.75M12 12h.75M16.5 12h.75m0 0a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75h.75zm-3.75 0a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75h.75zm-3.75 0a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75h.75z"/></svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-white">Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}</div>
        <div class="text-xs text-gray-500 mt-1">Current balance</div>
    </div>
</div>

<div class="grid lg:grid-cols-3 gap-6 mb-8">
    <div class="lg:col-span-2 glass-card p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-white">
                <span class="neon-text">Upcoming</span> Schedule
            </h2>
            <a href="{{ route('bookings.history') }}" class="text-xs text-blue-400 hover:text-blue-300 transition">View all</a>
        </div>
        @if ($upcomingBookings->count())
            <div class="space-y-3">
                @foreach ($upcomingBookings as $booking)
                    <a href="{{ route('bookings.show', $booking) }}" class="flex items-center gap-4 p-4 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 hover:border-blue-500/20 transition-all duration-300 group">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/20 to-purple-600/20 flex items-center justify-center text-center leading-tight">
                            <div>
                                <div class="text-xs font-bold text-blue-400">{{ $booking->concert->date->format('d') }}</div>
                                <div class="text-[9px] text-gray-500 uppercase">{{ $booking->concert->date->format('M') }}</div>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-semibold text-white truncate">{{ $booking->concert->title }}</span>
                                <span class="text-[10px] px-1.5 py-0.5 rounded bg-green-500/10 text-green-400 border border-green-500/20 font-medium">{{ $booking->quantity }} ticket</span>
                            </div>
                            <div class="flex items-center gap-3 mt-0.5 text-xs text-gray-500">
                                <span>{{ $booking->concert->date->format('l, d M Y') }}</span>
                                <span>·</span>
                                <span>{{ $booking->concert->time->format('H:i') }}</span>
                                <span>·</span>
                                <span>{{ $booking->concert->venue }}</span>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-gray-600 group-hover:text-blue-400 transition-colors flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-10">
                <div class="w-14 h-14 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                </div>
                <p class="text-gray-500 text-sm mb-3">No upcoming tickets scheduled</p>
                <a href="{{ route('concerts.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300">
                    Browse Concerts
                </a>
            </div>
        @endif
    </div>

    <div class="glass-card p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-white">Quick Actions</h2>
        </div>
        <div class="space-y-3">
            <a href="{{ route('concerts.index') }}" class="flex items-center gap-4 p-4 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 hover:border-blue-500/20 transition-all duration-300 group">
                <div class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400 group-hover:scale-110 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-white">Browse Concerts</p>
                    <p class="text-xs text-gray-500">Find and book tickets</p>
                </div>
            </a>
            <a href="{{ route('bookings.history') }}" class="flex items-center gap-4 p-4 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 hover:border-green-500/20 transition-all duration-300 group">
                <div class="w-10 h-10 rounded-lg bg-green-500/10 flex items-center justify-center text-green-400 group-hover:scale-110 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-white">My Tickets</p>
                    <p class="text-xs text-gray-500">View your bookings</p>
                </div>
            </a>
            <a href="{{ route('user.chat') }}" class="flex items-center gap-4 p-4 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 hover:border-purple-500/20 transition-all duration-300 group">
                <div class="w-10 h-10 rounded-lg bg-purple-500/10 flex items-center justify-center text-purple-400 group-hover:scale-110 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/></svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-white">Chat Admin</p>
                    <p class="text-xs text-gray-500">Get help & support</p>
                </div>
            </a>
            <a href="{{ route('user.withdrawals.index') }}" class="flex items-center gap-4 p-4 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 hover:border-amber-500/20 transition-all duration-300 group">
                <div class="w-10 h-10 rounded-lg bg-amber-500/10 flex items-center justify-center text-amber-400 group-hover:scale-110 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-white">Withdrawals</p>
                    <p class="text-xs text-gray-500">Withdraw your balance</p>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="glass-card p-6 mb-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-white">
            <span class="neon-text">Available</span> Concerts
        </h2>
        <a href="{{ route('concerts.index') }}" class="text-xs text-blue-400 hover:text-blue-300 transition">View all</a>
    </div>
    @if ($upcomingConcerts->count())
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($upcomingConcerts as $concert)
                <a href="{{ route('concerts.show', $concert) }}" class="group relative overflow-hidden rounded-xl bg-white/5 border border-white/5 hover:border-blue-500/30 transition-all duration-300">
                    @if ($concert->image)
                        <img src="{{ Storage::url($concert->image) }}" alt="" class="w-full h-28 object-cover">
                    @else
                        <div class="w-full h-28 bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"/></svg>
                        </div>
                    @endif
                    <div class="p-3">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-white truncate group-hover:text-blue-400 transition">{{ $concert->title }}</span>
                        </div>
                        <p class="text-[11px] text-gray-500 mt-0.5">{{ $concert->date->format('d M Y') }} · {{ $concert->venue }}</p>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-xs font-bold neon-text">Rp {{ number_format($concert->price, 0, ',', '.') }}</span>
                            <span class="text-[10px] text-gray-600">{{ $concert->available_seats }} seats</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center py-10">
            <p class="text-gray-500 text-sm">No upcoming concerts available.</p>
        </div>
    @endif
</div>

<div class="glass-card p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-white">Your Tickets</h2>
        <a href="{{ route('bookings.history') }}" class="text-xs text-blue-400 hover:text-blue-300 transition">View all</a>
    </div>
    @if ($bookings->count())
        <div class="space-y-3">
            @foreach ($bookings as $booking)
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-4 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 transition">
                    <div class="flex items-center gap-4">
                        @if ($booking->concert->image)
                            <img src="{{ Storage::url($booking->concert->image) }}" alt="" class="w-14 h-11 rounded-lg object-cover">
                        @else
                            <div class="w-14 h-11 rounded-lg bg-gray-800 flex items-center justify-center text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"/></svg>
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