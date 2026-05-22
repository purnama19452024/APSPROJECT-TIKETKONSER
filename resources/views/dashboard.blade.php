@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="relative py-24 md:py-32">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-xs tracking-[4px] uppercase text-blue-400 font-medium">Dashboard</span>
            <h1 class="text-3xl md:text-5xl font-bold mt-4 mb-4 text-white">Welcome, <span class="neon-text">{{ Auth::user()->name }}</span></h1>
            <p class="text-gray-400 max-w-xl mx-auto">Browse upcoming concerts and manage your tickets.</p>
        </div>

        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-white">Upcoming Concerts</h2>
                <a href="{{ route('concerts.index') }}" class="text-sm text-blue-400 hover:text-blue-300 transition">View All</a>
            </div>

            @if ($concerts->count())
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach ($concerts as $concert)
                        <div class="glass-card overflow-hidden group">
                            @if ($concert->image)
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ Storage::url($concert->image) }}" alt="{{ $concert->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" onerror="this.style.display='none'">
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-xs px-2 py-1 rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20">{{ $concert->date->format('d M Y') }}</span>
                                    <span class="text-xs text-gray-500">{{ $concert->time->format('H:i') }}</span>
                                </div>
                                <h3 class="text-lg font-semibold text-white mb-1">{{ $concert->title }}</h3>
                                <p class="text-sm text-gray-400 mb-1">{{ $concert->artist }}</p>
                                <p class="text-xs text-gray-500 mb-4">{{ $concert->venue }}, {{ $concert->city }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-bold neon-text">Rp {{ number_format($concert->price, 0, ',', '.') }}</span>
                                    <a href="{{ route('bookings.create', $concert) }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300 cta-btn">
                                        Book Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 glass-card">
                    <p class="text-gray-500">No upcoming concerts available.</p>
                </div>
            @endif
        </div>

        <div>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-white">My Bookings</h2>
                <a href="{{ route('bookings.history') }}" class="text-sm text-blue-400 hover:text-blue-300 transition">View All</a>
            </div>

            @if ($bookings->count())
                <div class="grid gap-4">
                    @foreach ($bookings as $booking)
                        <div class="glass-card p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-1">
                                    <h3 class="text-white font-semibold">{{ $booking->concert->title }}</h3>
                                    <span class="text-xs font-mono text-gray-500">{{ $booking->booking_code }}</span>
                                </div>
                                <p class="text-sm text-gray-400">{{ $booking->concert->date->format('d M Y') }} · {{ $booking->concert->venue }}</p>
                                <div class="flex items-center gap-4 mt-2 text-sm text-gray-500">
                                    <span>{{ $booking->quantity }} ticket(s)</span>
                                    <span class="neon-text font-semibold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                    <span class="text-xs uppercase tracking-wider text-gray-600">{{ $booking->payment_method }}</span>
                                    <span class="text-xs px-2 py-0.5 rounded-full
                                        @if($booking->payment_status === 'paid') bg-green-500/10 text-green-400
                                        @else bg-yellow-500/10 text-yellow-400 @endif">
                                        {{ ucfirst($booking->payment_status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-xs px-3 py-1 rounded-full font-medium
                                    @if($booking->status === 'confirmed') bg-green-500/10 text-green-400 border border-green-500/20
                                    @elseif($booking->status === 'cancelled') bg-red-500/10 text-red-400 border border-red-500/20
                                    @else bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                                <a href="{{ route('bookings.show', $booking) }}" class="text-sm text-blue-400 hover:text-blue-300 transition">Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 glass-card">
                    <p class="text-gray-500 mb-4">You haven't made any bookings yet.</p>
                    <a href="{{ route('concerts.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300 cta-btn">
                        Browse Concerts
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
