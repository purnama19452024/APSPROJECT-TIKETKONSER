@extends('admin.layouts.app')
@section('title', 'Create Invoice')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.invoices.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">&larr; Back to Invoices</a>
</div>

<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
        <h1 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Create Invoice</h1>

        <form method="POST" action="{{ route('admin.invoices.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Type</label>
                <div class="flex gap-4">
                    <label class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 cursor-pointer has-[:checked]:border-green-500 has-[:checked]:bg-green-50 dark:has-[:checked]:bg-green-900/20">
                        <input type="radio" name="type" value="incoming" {{ old('type') === 'outgoing' ? '' : 'checked' }} class="text-green-600">
                        <span class="text-sm text-gray-700 dark:text-gray-300">Incoming (Uang Masuk)</span>
                    </label>
                    <label class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 cursor-pointer has-[:checked]:border-red-500 has-[:checked]:bg-red-50 dark:has-[:checked]:bg-red-900/20">
                        <input type="radio" name="type" value="outgoing" {{ old('type') === 'outgoing' ? 'checked' : '' }} class="text-red-600">
                        <span class="text-sm text-gray-700 dark:text-gray-300">Outgoing (Uang Keluar)</span>
                    </label>
                </div>
                @error('type') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Amount (Rp)</label>
                <input type="number" name="amount" value="{{ old('amount') }}" required min="0"
                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-900 dark:text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    placeholder="100000">
                @error('amount') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Invoice Date</label>
                <input type="date" name="invoice_date" value="{{ old('invoice_date', date('Y-m-d')) }}" required
                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-900 dark:text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                @error('invoice_date') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Description (optional)</label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-900 dark:text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    placeholder="Description of this invoice">{{ old('description') }}</textarea>
                @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full py-3 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition">
                Create Invoice
            </button>
        </form>
    </div>
</div>
@endsection
