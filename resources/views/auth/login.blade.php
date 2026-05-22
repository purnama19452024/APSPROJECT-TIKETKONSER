<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-white">Welcome Back</h2>
            <p class="text-gray-400 text-sm mt-1">Sign in to your account</p>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1.5">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder-gray-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                placeholder="your@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1.5">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder-gray-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mb-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded bg-white/5 border-white/20 text-blue-500 focus:ring-blue-500 focus:ring-offset-0">
                <span class="ml-2 text-sm text-gray-400">Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-blue-400 hover:text-blue-300 transition">
                    Forgot password?
                </a>
            @endif
        </div>

        <button type="submit"
            class="w-full py-3.5 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300 shadow-lg shadow-blue-500/25 cta-btn">
            Sign In
        </button>

        <p class="text-center text-gray-500 text-sm mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 transition font-medium">Register</a>
        </p>
    </form>
</x-guest-layout>
