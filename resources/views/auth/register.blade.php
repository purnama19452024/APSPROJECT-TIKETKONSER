<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-white">Create Account</h2>
            <p class="text-gray-400 text-sm mt-1">Join APS PROJECT today</p>
        </div>

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-300 mb-1.5">Name</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder-gray-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                placeholder="Your name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1.5">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder-gray-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                placeholder="your@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1.5">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder-gray-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1.5">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder-gray-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit"
            class="w-full py-3.5 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300 shadow-lg shadow-blue-500/25 cta-btn">
            Create Account
        </button>

        <p class="text-center text-gray-500 text-sm mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 transition font-medium">Sign In</a>
        </p>
    </form>
</x-guest-layout>
