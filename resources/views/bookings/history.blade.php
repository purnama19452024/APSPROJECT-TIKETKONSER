@extends('layouts.app')
@section('title', 'My Bookings')
@section('content')
<div class="relative py-24 md:py-32">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-xs tracking-[4px] uppercase text-blue-400 font-medium">My Account</span>
            <h1 class="text-3xl md:text-5xl font-bold mt-4 mb-4 text-white">My <span class="neon-text">Bookings</span></h1>
            <p class="text-gray-400 max-w-xl mx-auto">View and manage all your ticket bookings.</p>
        </div>

        @if ($bookings->count())
            <div class="space-y-4">
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
                                <span class="text-xs px-1.5 py-0.5 rounded
                                    @if($booking->payment_status === 'paid') bg-green-500/10 text-green-400
                                    @else bg-yellow-500/10 text-yellow-400 @endif">
                                    {{ $booking->payment_status }}
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
            <div class="mt-8">
                {{ $bookings->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="text-6xl mb-4 opacity-30">🎫</div>
                <p class="text-gray-500 text-lg mb-4">You haven't made any bookings yet.</p>
                <a href="{{ route('concerts.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300 cta-btn">
                    Browse Concerts
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
