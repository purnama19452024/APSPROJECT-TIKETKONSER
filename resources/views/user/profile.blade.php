@extends('user.layouts.app')
@section('title', 'Profile')
@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-white">Profile</h1>
    <p class="text-gray-400 mt-1">Manage your account information.</p>
</div>

<div class="grid md:grid-cols-3 gap-8">
    <div class="md:col-span-1">
        <div class="glass-card p-6 text-center">
            <div class="mb-4">
                @if (Auth::user()->avatar)
                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Avatar" class="w-28 h-28 rounded-full object-cover mx-auto border-2 border-blue-500/30 cursor-pointer hover:opacity-80 transition" onclick="document.getElementById('photoModal').classList.remove('hidden')">
                @else
                    <div class="w-28 h-28 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-4xl font-bold mx-auto">{{ substr(Auth::user()->name, 0, 1) }}</div>
                @endif
            </div>
            <h2 class="text-lg font-semibold text-white">{{ Auth::user()->name }}</h2>
            <p class="text-sm text-gray-400">{{ Auth::user()->email }}</p>
            <span class="inline-block mt-2 text-xs px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20 capitalize">{{ Auth::user()->role }}</span>

            <form method="POST" action="{{ route('user.profile.avatar') }}" enctype="multipart/form-data" class="mt-6">
                @csrf
                <label class="block text-sm font-medium text-gray-300 mb-2 text-left">Change Photo</label>
                <input type="file" name="avatar" accept="image/jpeg,image/png,image/jpg,image/webp" required
                    class="w-full text-xs text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 transition cursor-pointer">
                @error('avatar') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                <button type="submit" class="w-full mt-3 py-2 rounded-lg text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition">Upload</button>
            </form>
        </div>
    </div>

    <div class="md:col-span-2">
        <div class="glass-card p-6">
            <h2 class="text-lg font-semibold text-white mb-6">Edit Profile</h2>
            <form method="POST" action="{{ route('user.profile.update') }}">
                @csrf @method('PUT')

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Name</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    @error('name') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    @error('email') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-6 py-3 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if (Auth::user()->avatar)
<div id="photoModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4" onclick="document.getElementById('photoModal').classList.add('hidden')">
    <div class="relative max-w-lg w-full" onclick="event.stopPropagation()">
        <button onclick="document.getElementById('photoModal').classList.add('hidden')" class="absolute -top-3 -right-3 w-8 h-8 rounded-full bg-gray-800 text-white flex items-center justify-center hover:bg-gray-700 transition z-10">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="" class="w-full rounded-2xl shadow-2xl border border-white/10">
    </div>
</div>
<script>
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            var m = document.getElementById('photoModal');
            if (m) m.classList.add('hidden');
        }
    });
</script>
@endif
@endsection
