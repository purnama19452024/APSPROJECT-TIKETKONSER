@extends('layouts.app')
@section('title', 'Book Tickets - ' . $concert->title)
@section('content')
<div class="relative py-24 md:py-32">
    <div class="max-w-2xl mx-auto px-4">
        <a href="{{ route('concerts.show', $concert) }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition mb-8 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back
        </a>

        <div class="glass-card p-8">
            <div class="mb-6">
                <span class="text-xs tracking-[4px] uppercase text-blue-400 font-medium">Booking</span>
                <h1 class="text-2xl font-bold text-white mt-2">Book Tickets</h1>
            </div>

            <div class="bg-white/5 rounded-xl p-4 mb-6">
                <h3 class="text-white font-semibold">{{ $concert->title }}</h3>
                <p class="text-gray-400 text-sm">{{ $concert->artist }} · {{ $concert->date->format('d M Y') }} · {{ $concert->venue }}</p>
                <div class="flex items-center justify-between mt-2 pt-2 border-t border-white/5">
                    <span class="text-sm text-gray-500">Price per ticket</span>
                    <span class="text-lg font-bold neon-text">Rp {{ number_format($concert->price, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center justify-between mt-1">
                    <span class="text-sm text-gray-500">Available seats</span>
                    <span class="text-sm text-gray-400">{{ $concert->available_seats }}</span>
                </div>
            </div>

            <form method="POST" action="{{ route('bookings.store', $concert) }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Number of Tickets</label>
                    <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" max="{{ $concert->available_seats }}" required
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        id="quantityInput"
                        oninput="updateTotal()">
                    @error('quantity')
                        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-3">Payment Method</label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="relative">
                            <input type="radio" name="payment_method" value="debit" class="sr-only peer" {{ old('payment_method', 'cash') == 'debit' ? 'checked' : '' }}>
                            <div class="flex flex-col items-center gap-2 p-4 rounded-xl bg-white/5 border border-white/10 text-gray-400 peer-checked:border-blue-500 peer-checked:bg-blue-500/10 peer-checked:text-blue-400 cursor-pointer transition hover:bg-white/10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                <span class="text-xs font-medium">Debit</span>
                            </div>
                        </label>
                        <label class="relative">
                            <input type="radio" name="payment_method" value="qris" class="sr-only peer" {{ old('payment_method') == 'qris' ? 'checked' : '' }}>
                            <div class="flex flex-col items-center gap-2 p-4 rounded-xl bg-white/5 border border-white/10 text-gray-400 peer-checked:border-blue-500 peer-checked:bg-blue-500/10 peer-checked:text-blue-400 cursor-pointer transition hover:bg-white/10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                                <span class="text-xs font-medium">QRIS</span>
                            </div>
                        </label>
                        <label class="relative">
                            <input type="radio" name="payment_method" value="cash" class="sr-only peer" {{ old('payment_method', 'cash') == 'cash' ? 'checked' : '' }}>
                            <div class="flex flex-col items-center gap-2 p-4 rounded-xl bg-white/5 border border-white/10 text-gray-400 peer-checked:border-blue-500 peer-checked:bg-blue-500/10 peer-checked:text-blue-400 cursor-pointer transition hover:bg-white/10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-xs font-medium">Cash</span>
                            </div>
                        </label>
                    </div>
                    @error('payment_method')
                        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6" id="proofUpload">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Payment Proof <span class="text-gray-500 font-normal">(optional)</span></label>
                    <div class="relative">
                        <input type="file" name="payment_proof" accept="image/jpeg,image/png,image/jpg,image/webp"
                            class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-300 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 transition cursor-pointer">
                    </div>
                    <p class="text-xs text-gray-500 mt-1.5">Upload screenshot or photo of payment (max 2MB, jpg/png/webp)</p>
                    @error('payment_proof')
                        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-white/5 rounded-xl p-4 mb-8">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-400 text-sm">Total Price</span>
                        <span class="text-2xl font-bold neon-text" id="totalDisplay">Rp {{ number_format($concert->price, 0, ',', '.') }}</span>
                    </div>
                </div>

                <button type="submit" class="w-full py-4 rounded-2xl text-base font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300 shadow-lg shadow-blue-500/25 cta-btn">
                    Confirm Booking
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const price = {{ $concert->price }};
    function updateTotal() {
        const qty = parseInt(document.getElementById('quantityInput').value) || 1;
        const total = price * qty;
        document.getElementById('totalDisplay').textContent = 'Rp ' + total.toLocaleString('id-ID');
    }
</script>
@endsection
