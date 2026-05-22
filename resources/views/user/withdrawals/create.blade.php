@extends('user.layouts.app')
@section('title', 'New Withdrawal')
@section('content')
<div class="mb-6">
    <a href="{{ route('user.withdrawals.index') }}" class="text-blue-400 hover:underline text-sm">&larr; Back to Withdrawals</a>
</div>

<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
        <h1 class="text-xl font-bold text-gray-900 dark:text-white mb-2">New Withdrawal Request</h1>
        <p class="text-sm text-gray-500 mb-6">Saldo Anda saat ini: <span class="font-semibold text-cyan-400">Rp {{ number_format($balance, 0, ',', '.') }}</span></p>

        <form method="POST" action="{{ route('user.withdrawals.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Amount (Rp)</label>
                <input type="number" name="amount" value="{{ old('amount') }}" required min="10000"
                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-900 dark:text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    placeholder="100000">
                <p class="text-xs text-gray-500 mt-1">Minimal penarikan Rp 10.000</p>
                @error('amount') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Bank Name</label>
                <input type="text" name="bank_name" value="{{ old('bank_name') }}" required
                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-900 dark:text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    placeholder="BCA, Mandiri, BRI, etc.">
                @error('bank_name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Account Number</label>
                <input type="text" name="account_number" value="{{ old('account_number') }}" required
                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-900 dark:text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    placeholder="1234567890">
                @error('account_number') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Account Holder</label>
                <input type="text" name="account_holder" value="{{ old('account_holder') }}" required
                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-900 dark:text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    placeholder="John Doe">
                @error('account_holder') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full py-3 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition">
                Submit Withdrawal Request
            </button>
        </form>
    </div>
</div>
@endsection
