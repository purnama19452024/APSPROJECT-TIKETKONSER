@extends('layouts.app')
@section('title', 'Ticket - ' . $booking->booking_code)
@php
    function generateBars($code) {
        $chars = str_split(preg_replace('/[^A-Za-z0-9]/', '', $code));
        $bars = '';
        foreach ($chars as $c) {
            $w = (ord($c) % 4) + 2;
            $h = (ord($c) % 30) + 30;
            $bars .= '<span style="display:inline-block;width:'.$w.'px;height:'.$h.'px;background:#111;margin:0 1px"></span>';
        }
        return $bars;
    }
@endphp
@section('content')
<div class="relative py-24 md:py-32">
    <div class="max-w-3xl mx-auto px-4">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-white mb-1">Your Ticket</h1>
            <p class="text-gray-400 text-sm">Show this ticket at the venue entrance</p>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-2xl">
            <div class="p-0">
                <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-500 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center text-white font-bold text-lg">A</div>
                        <div>
                            <span class="text-white font-bold text-lg tracking-tight">APS<span class="text-white/70"> PROJECT</span></span>
                            <p class="text-white/60 text-xs">Official Ticket</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-white/80 text-xs font-medium uppercase tracking-wider">{{ $booking->status === 'confirmed' ? 'Confirmed' : ucfirst($booking->status) }}</p>
                        <p class="text-white/50 text-[10px]">{{ $booking->booking_code }}</p>
                    </div>
                </div>

                <div class="p-6 md:p-8">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="flex-1">
                            <p class="text-gray-400 text-xs uppercase tracking-wider font-medium mb-1">{{ $booking->concert->date->format('l') }}</p>
                            <p class="text-4xl md:text-5xl font-black text-gray-900 leading-tight">{{ $booking->concert->date->format('d') }}</p>
                            <p class="text-lg font-semibold text-gray-700 mb-4">{{ $booking->concert->date->format('F Y') }}</p>

                            <div class="border-t border-gray-200 pt-4 mt-4">
                                <h2 class="text-2xl md:text-3xl font-black text-gray-900 leading-tight">{{ $booking->concert->title }}</h2>
                                <p class="text-gray-500 font-medium mt-1">{{ $booking->concert->artist }}</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mt-6">
                                <div>
                                    <p class="text-gray-400 text-xs uppercase tracking-wider font-medium">Time</p>
                                    <p class="text-gray-900 font-semibold">{{ $booking->concert->time->format('H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs uppercase tracking-wider font-medium">Gate</p>
                                    <p class="text-gray-900 font-semibold">Main Entrance</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-400 text-xs uppercase tracking-wider font-medium">Venue</p>
                                    <p class="text-gray-900 font-semibold">{{ $booking->concert->venue }}, {{ $booking->concert->city }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="md:w-48 flex-shrink-0">
                            <div class="bg-gray-50 rounded-xl p-4 text-center">
                                <p class="text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">Tickets</p>
                                <p class="text-3xl font-black text-gray-900">{{ $booking->quantity }}</p>
                                <p class="text-gray-500 text-sm font-medium">{{ $booking->quantity > 1 ? 'Tickets' : 'Ticket' }}</p>

                                <div class="border-t border-gray-200 my-4 pt-4">
                                    <p class="text-gray-400 text-xs uppercase tracking-wider font-medium mb-1">Total</p>
                                    <p class="text-xl font-black text-gray-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                </div>

                                <div class="border-t border-gray-200 my-4 pt-4">
                                    <p class="text-gray-400 text-xs uppercase tracking-wider font-medium mb-1">Payment</p>
                                    <p class="text-gray-900 text-sm font-semibold uppercase">{{ $booking->payment_method }}</p>
                                    <p class="text-xs font-medium {{ $booking->payment_status === 'paid' ? 'text-green-600' : 'text-yellow-600' }}">{{ ucfirst($booking->payment_status) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="border-t-2 border-dashed border-gray-300 mx-6"></div>
                    <div class="absolute -left-3 -top-3 w-6 h-6 rounded-full bg-gray-900"></div>
                    <div class="absolute -right-3 -top-3 w-6 h-6 rounded-full bg-gray-900"></div>
                </div>

                <div class="px-6 md:px-8 py-4 bg-gray-50">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-1 py-2 px-1 bg-white rounded border border-gray-200" style="min-height:50px">
                                {!! generateBars($booking->booking_code) !!}
                            </div>
                            <div>
                                <p class="text-xs font-mono font-bold text-gray-900 tracking-wider">{{ $booking->booking_code }}</p>
                                <p class="text-[10px] text-gray-400">Booking Reference</p>
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="text-[10px] text-gray-400">Issued by APS PROJECT</p>
                            <p class="text-[10px] text-gray-400">{{ now()->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 text-center">
            <p class="text-gray-500 text-xs">Present this ticket (digital or printed) at the venue entrance.</p>
        </div>

        @if ($booking->payment_proof)
            <div class="mt-8 bg-white/5 rounded-xl p-6">
                <h3 class="text-white font-semibold mb-3">Payment Proof</h3>
                <img src="{{ Storage::url($booking->payment_proof) }}" alt="Payment Proof" class="w-full max-w-sm mx-auto rounded-lg border border-white/10 cursor-pointer hover:opacity-80 transition" onclick="document.getElementById('proofModal').classList.remove('hidden')">
            </div>
            <div id="proofModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4" onclick="document.getElementById('proofModal').classList.add('hidden')">
                <div class="relative max-w-2xl w-full" onclick="event.stopPropagation()">
                    <button onclick="document.getElementById('proofModal').classList.add('hidden')" class="absolute -top-3 -right-3 w-8 h-8 rounded-full bg-gray-800 text-white flex items-center justify-center hover:bg-gray-700 transition z-10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    <img src="{{ Storage::url($booking->payment_proof) }}" alt="Payment Proof" class="w-full rounded-2xl shadow-2xl border border-white/10">
                </div>
            </div>
            <script>
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        var m = document.getElementById('proofModal');
                        if (m) m.classList.add('hidden');
                    }
                });
            </script>
        @elseif ($booking->payment_method !== 'cash')
            <div class="mt-8 bg-white/5 rounded-xl p-6">
                <h3 class="text-white font-semibold mb-3">Upload Payment Proof</h3>
                <form method="POST" action="{{ route('bookings.proof', $booking) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <input type="file" name="payment_proof" accept="image/jpeg,image/png,image/jpg,image/webp" required
                            class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-300 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 transition cursor-pointer">
                    </div>
                    <button type="submit" class="px-6 py-3 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300 cta-btn">
                        Upload Proof
                    </button>
                </form>
            </div>
        @endif

        <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('bookings.history') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300 cta-btn">
                My Bookings
            </a>
            <a href="{{ route('concerts.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-medium text-white/80 glass hover:text-white transition border border-white/10">
                Browse Concerts
            </a>
        </div>
    </div>
</div>
@endsection
