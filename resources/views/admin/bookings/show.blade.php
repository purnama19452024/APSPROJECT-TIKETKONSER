@extends('admin.layouts.app')
@section('title', 'Booking Detail')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.bookings.index') }}" class="text-sm text-blue-600 hover:text-blue-700">&larr; Back to Bookings</a>
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mt-2">Booking Detail</h1>
</div>

<div class="grid md:grid-cols-2 gap-6">
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Booking Info</h2>
        <dl class="space-y-3">
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Code</dt>
                <dd class="text-sm font-mono font-medium text-gray-900 dark:text-white">{{ $booking->booking_code }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Status</dt>
                <dd>
                    <span class="text-xs px-2 py-1 rounded-full font-medium
                        @if($booking->status === 'confirmed') bg-green-100 text-green-700
                        @elseif($booking->status === 'cancelled') bg-red-100 text-red-700
                        @elseif($booking->status === 'expired') bg-gray-100 text-gray-500
                        @else bg-yellow-100 text-yellow-700 @endif">
                        {{ ucfirst($booking->status) }}
                    </span>
                </dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Quantity</dt>
                <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->quantity }} ticket(s)</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Total Price</dt>
                <dd class="text-sm font-bold text-gray-900 dark:text-white">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Payment Method</dt>
                <dd class="text-sm font-medium text-gray-900 dark:text-white uppercase">{{ $booking->payment_method }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Payment Status</dt>
                <dd>
                    <span class="text-xs px-2 py-1 rounded-full font-medium
                        @if($booking->payment_status === 'paid') bg-green-100 text-green-700
                        @else bg-yellow-100 text-yellow-700 @endif">
                        {{ ucfirst($booking->payment_status) }}
                    </span>
                </dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Booked At</dt>
                <dd class="text-sm text-gray-900 dark:text-white">{{ $booking->created_at->format('d M Y H:i') }}</dd>
            </div>
        </dl>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Customer Info</h2>
        <dl class="space-y-3">
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Name</dt>
                <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->user?->name ?? 'N/A' }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Email</dt>
                <dd class="text-sm text-gray-900 dark:text-white">{{ $booking->user?->email ?? 'N/A' }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">User Balance</dt>
                <dd class="text-sm font-semibold {{ $booking->user && $booking->user->balance >= $booking->total_price ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                    Rp {{ number_format($booking->user?->balance ?? 0, 0, ',', '.') }}
                </dd>
            </div>
        </dl>
        @if ($booking->user && $booking->user->balance < $booking->total_price)
            <div class="mt-4 p-3 rounded-lg bg-red-50 dark:bg-red-950 border border-red-200 dark:border-red-800">
                <p class="text-sm text-red-700 dark:text-red-300 font-medium">Saldo tidak mencukupi. Mohon top up terlebih dahulu.</p>
                <a href="{{ route('admin.users.show', $booking->user) }}" class="mt-2 inline-block text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 font-medium">Top Up Now &rarr;</a>
            </div>
        @endif
    </div>

    <div class="md:col-span-2 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Concert Info</h2>
        <dl class="space-y-3">
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Concert</dt>
                <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->concert?->title ?? 'N/A' }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Artist</dt>
                <dd class="text-sm text-gray-900 dark:text-white">{{ $booking->concert?->artist ?? 'N/A' }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Date & Time</dt>
                <dd class="text-sm text-gray-900 dark:text-white">
                    @if ($booking->concert)
                        {{ $booking->concert->date->format('d M Y') }} at {{ $booking->concert->time->format('H:i') }}
                    @else
                        N/A
                    @endif
                </dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Venue</dt>
                <dd class="text-sm text-gray-900 dark:text-white">{{ $booking->concert?->venue }}, {{ $booking->concert?->city }}</dd>
            </div>
        </dl>
    </div>

    @if ($booking->payment_proof)
        <div class="md:col-span-2 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Payment Proof</h2>
            <img src="{{ Storage::url($booking->payment_proof) }}" alt="Payment Proof" class="max-w-md rounded-lg border border-gray-200 dark:border-gray-700 cursor-pointer hover:opacity-80 transition" onclick="document.getElementById('proofModal').classList.remove('hidden')">
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
    @endif
</div>

<div class="mt-6 flex items-center gap-3">
    @if ($booking->status === 'pending')
        <form action="{{ route('admin.bookings.confirm', $booking) }}" method="POST">
            @csrf @method('PATCH')
            <button type="submit" class="px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-green-600 hover:bg-green-700 transition">Confirm Booking</button>
        </form>
        <form action="{{ route('admin.bookings.cancel', $booking) }}" method="POST">
            @csrf @method('PATCH')
            <button type="submit" class="px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-red-600 hover:bg-red-700 transition">Cancel Booking</button>
        </form>
    @elseif ($booking->status === 'confirmed')
        <form action="{{ route('admin.bookings.cancel', $booking) }}" method="POST">
            @csrf @method('PATCH')
            <button type="submit" class="px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-red-600 hover:bg-red-700 transition">Cancel Booking</button>
        </form>
    @endif
</div>
@endsection
