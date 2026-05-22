@extends('layouts.app')
@section('title', $concert->title)
@section('content')
<div class="relative py-24 md:py-32">
    <div class="max-w-4xl mx-auto px-4">
        <a href="{{ route('concerts.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition mb-8 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Concerts
        </a>

        <div class="glass-card overflow-hidden">
            @if ($concert->image)
                <div class="h-64 md:h-80 overflow-hidden">
                    <img src="{{ Storage::url($concert->image) }}" alt="{{ $concert->title }}" class="w-full h-full object-cover" onerror="this.style.display='none'">
                </div>
            @endif
            <div class="p-8 md:p-10">
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <span class="text-xs px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20">{{ $concert->date->format('l, d M Y') }}</span>
                    <span class="text-xs text-gray-400">{{ $concert->time->format('H:i') }} WIB</span>
                    @if ($concert->available_seats > 0)
                        <span class="text-xs px-3 py-1 rounded-full bg-green-500/10 text-green-400 border border-green-500/20">{{ $concert->available_seats }} seats left</span>
                    @else
                        <span class="text-xs px-3 py-1 rounded-full bg-red-500/10 text-red-400 border border-red-500/20">Sold Out</span>
                    @endif
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $concert->title }}</h1>
                <p class="text-lg text-gray-400 mb-6">{{ $concert->artist }}</p>

                <div class="flex items-center gap-6 mb-8 text-sm text-gray-500">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        {{ $concert->venue }}, {{ $concert->city }}
                    </span>
                </div>

                @if ($concert->description)
                    <div class="mb-8">
                        <h3 class="text-sm font-semibold text-white mb-2">About This Event</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">{{ $concert->description }}</p>
                    </div>
                @endif

                <div class="flex items-center justify-between pt-6 border-t border-white/5">
                    <div>
                        <span class="text-xs text-gray-500">Price per ticket</span>
                        <div class="text-3xl font-bold neon-text mt-1">Rp {{ number_format($concert->price, 0, ',', '.') }}</div>
                    </div>
                    @auth
                        @if ($concert->available_seats > 0 && $concert->status === 'active')
                            <a href="{{ route('bookings.create', $concert) }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl text-base font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300 shadow-lg shadow-blue-500/25 cta-btn">
                                Book Now
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        @else
                            <span class="px-6 py-3 rounded-2xl text-base font-medium text-gray-500 glass border border-white/5">Sold Out</span>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl text-base font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300 shadow-lg shadow-blue-500/25 cta-btn">
                            Login to Book
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
