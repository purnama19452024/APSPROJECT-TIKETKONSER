@extends('admin.layouts.app')
@section('title', 'Manage Bookings')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Bookings</h1>
    <p class="text-gray-500 dark:text-gray-400 mt-1">Manage all ticket bookings.</p>
</div>

<div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
    @if ($bookings->count())
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-800">
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Code</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">User</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Concert</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Qty</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Total</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Payment</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Status</th>
                        <th class="text-right px-4 py-3 font-medium text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach ($bookings as $booking)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30">
                            <td class="px-4 py-3 font-mono font-medium text-gray-900 dark:text-white">{{ $booking->booking_code }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $booking->user?->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $booking->concert?->title ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $booking->quantity }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                <span class="text-xs uppercase text-gray-500">{{ $booking->payment_method }}</span>
                                <span class="text-xs ml-1 px-1.5 py-0.5 rounded
                                    @if($booking->payment_status === 'paid') bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400
                                    @else bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400 @endif">
                                    {{ $booking->payment_status }}
                                </span>
                                @if ($booking->payment_proof)
                                    <span class="text-xs ml-1 px-1.5 py-0.5 rounded bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400" title="Ada bukti transfer">📎</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-xs px-2 py-1 rounded-full font-medium
                                    @if($booking->status === 'confirmed') bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400
                                    @elseif($booking->status === 'cancelled') bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400
                                    @else bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400 @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.bookings.show', $booking) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">Detail</a>
                                @if ($booking->status === 'pending')
                                    <form action="{{ route('admin.bookings.confirm', $booking) }}" method="POST" class="inline ml-2">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="text-green-600 hover:text-green-700 text-sm font-medium">Confirm</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-800">
            {{ $bookings->links() }}
        </div>
    @else
        <div class="text-center py-12 text-gray-500">
            <p>No bookings yet.</p>
        </div>
    @endif
</div>
@endsection
