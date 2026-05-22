@extends('admin.layouts.app')
@section('title', 'Withdrawal Detail')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.withdrawals.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">&larr; Back to Withdrawals</a>
</div>

<div class="max-w-3xl mx-auto">
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Withdrawal #{{ $withdrawal->id }}</h1>
            <span class="text-xs px-3 py-1.5 rounded-full font-medium
                @if($withdrawal->status === 'pending') bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400
                @elseif($withdrawal->status === 'approved') bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400
                @else bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 @endif">
                {{ ucfirst($withdrawal->status) }}
            </span>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">User</p>
                <p class="text-gray-900 dark:text-white font-medium">{{ $withdrawal->user?->name }}</p>
                <p class="text-sm text-gray-500">{{ $withdrawal->user?->email }}</p>
                <p class="text-xs text-gray-500 mt-1">Saldo: <span class="font-semibold text-cyan-400">Rp {{ number_format($withdrawal->user?->balance ?? 0, 0, ',', '.') }}</span></p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Amount</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Bank</p>
                <p class="text-gray-900 dark:text-white font-medium">{{ $withdrawal->bank_name }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Account Number</p>
                <p class="text-gray-900 dark:text-white font-mono">{{ $withdrawal->account_number }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Account Holder</p>
                <p class="text-gray-900 dark:text-white font-medium">{{ $withdrawal->account_holder }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Request Date</p>
                <p class="text-gray-900 dark:text-white">{{ $withdrawal->created_at->format('d M Y H:i') }}</p>
            </div>
            @if ($withdrawal->approved_at)
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Approved At</p>
                <p class="text-green-600 dark:text-green-400">{{ $withdrawal->approved_at->format('d M Y H:i') }}</p>
            </div>
            @endif
            @if ($withdrawal->rejected_at)
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Rejected At</p>
                <p class="text-red-600 dark:text-red-400">{{ $withdrawal->rejected_at->format('d M Y H:i') }}</p>
            </div>
            @endif
        </div>

        @if ($withdrawal->notes)
        <div class="mb-6 p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Notes</p>
            <p class="text-gray-700 dark:text-gray-300">{{ $withdrawal->notes }}</p>
        </div>
        @endif

        @if ($withdrawal->invoice)
        <div class="mb-6 p-4 rounded-lg bg-blue-50 dark:bg-blue-900/10 border border-blue-200 dark:border-blue-800">
            <p class="text-xs text-blue-600 dark:text-blue-400 uppercase tracking-wider mb-1">Invoice</p>
            <p class="text-sm text-blue-800 dark:text-blue-200">
                {{ $withdrawal->invoice->invoice_number }}
                <a href="{{ route('admin.invoices.show', $withdrawal->invoice) }}" class="text-blue-600 dark:text-blue-400 hover:underline ml-2">View Invoice &rarr;</a>
            </p>
        </div>
        @endif

        @if ($withdrawal->status === 'pending')
        <div class="flex items-center gap-3 pt-4 border-t border-gray-200 dark:border-gray-800">
            @if (Auth::user()->isAdmin())
            <form action="{{ route('admin.withdrawals.approve', $withdrawal) }}" method="POST" class="inline" onsubmit="return confirm('Approve this withdrawal?')">
                @csrf @method('PATCH')
                <button type="submit" class="px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-green-600 hover:bg-green-700 transition">
                    Approve
                </button>
            </form>
            <form action="{{ route('admin.withdrawals.reject', $withdrawal) }}" method="POST" class="inline" onsubmit="return confirm('Reject this withdrawal?')">
                @csrf
                <button type="submit" class="px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-red-600 hover:bg-red-700 transition">
                    Reject
                </button>
            </form>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection
