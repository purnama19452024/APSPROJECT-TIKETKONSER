<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Invoice;
use App\Notifications\BookingConfirmed;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(): View
    {
        $bookings = Booking::with(['user', 'concert'])->latest()->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking): View
    {
        $booking->load(['user', 'concert']);

        return view('admin.bookings.show', compact('booking'));
    }

    public function confirm(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->withErrors(['status' => 'Only pending bookings can be confirmed.']);
        }

        if ($booking->user->balance < $booking->total_price) {
            return back()->withErrors(['balance' => 'Saldo user tidak mencukupi. Mohon top up terlebih dahulu.']);
        }

        $booking->update([
            'status' => 'confirmed',
            'payment_status' => 'paid',
        ]);

        $booking->user->decrement('balance', $booking->total_price);
        $booking->user->notify(new BookingConfirmed($booking));

        $timestamp = now()->format('ymdHis');
        Invoice::create([
            'invoice_number' => 'INV-IN-'.$timestamp,
            'type' => 'incoming',
            'amount' => $booking->total_price,
            'description' => 'Ticket payment - '.$booking->concert?->title.' ('.$booking->user->name.')',
            'invoice_date' => now()->toDateString(),
            'reference_type' => Booking::class,
            'reference_id' => $booking->id,
        ]);

        return back()->with('success', 'Booking berhasil dikonfirmasi! Saldo user telah dipotong.');
    }

    public function cancel(Booking $booking)
    {
        $wasConfirmed = $booking->status === 'confirmed';

        $booking->update(['status' => 'cancelled']);

        $booking->concert()->increment('available_seats', $booking->quantity);

        if ($wasConfirmed) {
            $booking->user->increment('balance', $booking->total_price);
        }

        return back()->with('success', 'Booking berhasil dibatalkan!');
    }
}
