@extends('admin.layouts.app')
@section('title', 'Invoice Detail')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.invoices.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">&larr; Back to Invoices</a>
</div>

<div class="max-w-3xl mx-auto">
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">{{ $invoice->invoice_number }}</h1>
            <div class="flex items-center gap-2">
                <span class="text-xs px-3 py-1.5 rounded-full font-medium
                    @if($invoice->type === 'incoming') bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400
                    @else bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 @endif">
                    {{ ucfirst($invoice->type) }}
                </span>
                <a href="{{ route('admin.invoices.pdf', $invoice) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-white bg-red-600 hover:bg-red-700 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    PDF
                </a>
                <a href="{{ route('admin.invoices.word', $invoice) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                    Word
                </a>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Amount</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Date</p>
                <p class="text-gray-900 dark:text-white">{{ $invoice->invoice_date->format('d M Y') }}</p>
            </div>
            @if ($invoice->description)
            <div class="col-span-2">
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Description</p>
                <p class="text-gray-700 dark:text-gray-300">{{ $invoice->description }}</p>
            </div>
            @endif
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Created</p>
                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $invoice->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <div class="pt-6 border-t border-gray-200 dark:border-gray-800">
            <p class="text-xs text-gray-500 uppercase tracking-wider mb-3">Signature</p>
            <div class="flex items-center gap-6">
                @if ($invoice->signature)
                    <img src="{{ Storage::url($invoice->signature) }}" alt="Signature" class="h-16 object-contain border border-gray-200 dark:border-gray-700 rounded-lg p-2">
                @else
                    <p class="text-gray-400 text-sm italic">No signature uploaded</p>
                @endif
                @if (Auth::user()->isAdmin())
                <form action="{{ route('admin.invoices.signature', $invoice) }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-3">
                    @csrf
                    <input type="file" name="signature" accept="image/*" required
                        class="text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 dark:file:bg-blue-900/30 dark:file:text-blue-400 transition cursor-pointer">
                    <button type="submit" class="px-4 py-1.5 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition">Upload</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
