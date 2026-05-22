@extends('user.layouts.app')
@section('title', 'Kritik & Saran')
@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-white">Kritik & Saran</h1>
    <p class="text-gray-400 mt-1">Kami sangat menghargai masukan dari Anda.</p>
</div>

<div class="max-w-2xl">
    <div class="glass-card p-8">
        <form method="POST" action="{{ route('user.feedback.store') }}">
            @csrf
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-3">Type</label>
                <div class="grid grid-cols-3 gap-3">
                    <label class="relative">
                        <input type="radio" name="type" value="kritik" class="sr-only peer" {{ old('type', 'saran') == 'kritik' ? 'checked' : '' }}>
                        <div class="text-center p-3 rounded-xl bg-white/5 border border-white/10 text-gray-400 peer-checked:border-red-500 peer-checked:bg-red-500/10 peer-checked:text-red-400 cursor-pointer transition text-sm font-medium">Kritik</div>
                    </label>
                    <label class="relative">
                        <input type="radio" name="type" value="saran" class="sr-only peer" {{ old('type', 'saran') == 'saran' ? 'checked' : '' }}>
                        <div class="text-center p-3 rounded-xl bg-white/5 border border-white/10 text-gray-400 peer-checked:border-blue-500 peer-checked:bg-blue-500/10 peer-checked:text-blue-400 cursor-pointer transition text-sm font-medium">Saran</div>
                    </label>
                    <label class="relative">
                        <input type="radio" name="type" value="lainnya" class="sr-only peer" {{ old('type') == 'lainnya' ? 'checked' : '' }}>
                        <div class="text-center p-3 rounded-xl bg-white/5 border border-white/10 text-gray-400 peer-checked:border-purple-500 peer-checked:bg-purple-500/10 peer-checked:text-purple-400 cursor-pointer transition text-sm font-medium">Lainnya</div>
                    </label>
                </div>
                @error('type') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-2">Message</label>
                <textarea name="message" rows="5" required class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder-gray-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition" placeholder="Tulis kritik, saran, atau masukan Anda...">{{ old('message') }}</textarea>
                @error('message') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="px-8 py-3.5 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300 shadow-lg shadow-blue-500/25 cta-btn">
                Submit
            </button>
        </form>
    </div>
</div>
@endsection
