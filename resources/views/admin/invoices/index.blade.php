@extends('admin.layouts.app')
@section('title', 'Invoices')
@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Invoices</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1">Track money in and money out.</p>
    </div>
    @if (Auth::user()->isAdmin())
    <a href="{{ route('admin.invoices.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Invoice
    </a>
    @endif
</div>

<div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
    @if ($invoices->count())
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-800">
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Invoice #</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Type</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Amount</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Date</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Description</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Signature</th>
                        <th class="text-right px-4 py-3 font-medium text-gray-500">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach ($invoices as $inv)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30">
                            <td class="px-4 py-3 font-mono text-sm text-gray-900 dark:text-white">{{ $inv->invoice_number }}</td>
                            <td class="px-4 py-3">
                                <span class="text-xs px-2 py-1 rounded-full font-medium
                                    @if($inv->type === 'incoming') bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400
                                    @else bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 @endif">
                                    {{ ucfirst($inv->type) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-900 dark:text-white font-medium">Rp {{ number_format($inv->amount, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $inv->invoice_date->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-gray-500 dark:text-gray-400 max-w-xs truncate">{{ $inv->description ?? '-' }}</td>
                            <td class="px-4 py-3">
                                @if ($inv->signature)
                                    <img src="{{ Storage::url($inv->signature) }}" alt="Signature" class="h-8 object-contain">
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.invoices.show', $inv) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-800">{{ $invoices->links() }}</div>
    @else
        <div class="text-center py-12 text-gray-500"><p>No invoices yet.</p></div>
    @endif
</div>
@endsection
