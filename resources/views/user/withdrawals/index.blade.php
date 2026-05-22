@extends('user.layouts.app')
@section('title', 'Withdrawals')
@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Withdrawals</h1>
            <p class="text-gray-400 mt-1">Riwayat penarikan saldo Anda.</p>
        </div>
        <a href="{{ route('user.withdrawals.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Withdrawal
        </a>
    </div>
    <div class="mt-4 p-4 rounded-lg bg-cyan-500/5 border border-cyan-500/20 inline-block">
        <span class="text-sm text-gray-400">Saldo saat ini:</span>
        <span class="text-lg font-bold text-cyan-400 ml-2">Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}</span>
    </div>
</div>

<div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
    @if ($withdrawals->count())
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-800">
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Amount</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Bank</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Account</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Status</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach ($withdrawals as $w)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30">
                            <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">Rp {{ number_format($w->amount, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $w->bank_name }}</td>
                            <td class="px-4 py-3">
                                <span class="text-gray-900 dark:text-white text-xs font-mono">{{ $w->account_number }}</span>
                                <span class="text-gray-500 text-xs block">{{ $w->account_holder }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-xs px-2 py-1 rounded-full font-medium
                                    @if($w->status === 'pending') bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400
                                    @elseif($w->status === 'approved') bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400
                                    @else bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 @endif">
                                    {{ ucfirst($w->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $w->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-800">{{ $withdrawals->links() }}</div>
    @else
        <div class="text-center py-12 text-gray-500"><p>No withdrawals yet.</p></div>
    @endif
</div>
@endsection
