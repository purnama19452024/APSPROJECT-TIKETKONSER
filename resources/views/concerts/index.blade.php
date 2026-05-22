@extends('layouts.app')
@section('title', 'Upcoming Concerts')
@section('content')
<div class="relative py-24 md:py-32">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-16">
            <span class="text-xs tracking-[4px] uppercase text-blue-400 font-medium">Concerts</span>
            <h1 class="text-4xl md:text-6xl font-bold mt-4 mb-4 text-white">Upcoming <span class="neon-text">Events</span></h1>
            <p class="text-gray-400 max-w-xl mx-auto">Discover and book tickets for the hottest concerts in town.</p>
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
                                <a href="{{ route('concerts.show', $concert) }}" class="px-4 py-2 rounded-xl text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300 cta-btn">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-10">
                {{ $concerts->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <div class="text-6xl mb-4 opacity-30">🎵</div>
                <p class="text-gray-500 text-lg">No upcoming concerts at the moment. Check back later!</p>
            </div>
        @endif
    </div>
</div>
@endsection
