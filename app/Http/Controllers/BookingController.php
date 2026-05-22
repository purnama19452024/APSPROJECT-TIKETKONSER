<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Concert;
use App\Models\User;
use App\Notifications\NewBooking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function create(Concert $concert): View
    {
        return view('bookings.create', compact('concert'));
    }

    public function store(Request $request, Concert $concert): RedirectResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:'.$concert->available_seats,
            'payment_method' => 'required|in:debit,qris,cash',
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($concert->available_seats < $request->quantity) {
            return back()->withErrors(['quantity' => 'Maaf, kursi tidak mencukupi!']);
        }

        $totalPrice = $concert->price * $request->quantity;

        $data = [
            'concert_id' => $concert->id,
            'user_id' => Auth::id(),
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_method === 'cash' ? 'pending' : ($request->hasFile('payment_proof') ? 'paid' : 'pending'),
            'booking_code' => 'TIX-'.strtoupper(uniqid()),
            'status' => 'pending',
        ];

        if ($request->hasFile('payment_proof')) {
            $data['payment_proof'] = $request->file('payment_proof')->store('payment-proofs', 'public');
        }

        $booking = Booking::create($data);

        $concert->decrement('available_seats', $request->quantity);

        User::whereIn('role', ['admin', 'supervisor'])->get()->each->notify(new NewBooking($booking));

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking berhasil! Kode booking: '.$booking->booking_code);
    }

    public function show(Booking $booking): View
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->load('concert');

        return view('bookings.show', compact('booking'));
    }

    public function history(): View
    {
        $bookings = Booking::with('concert')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('bookings.history', compact('bookings'));
    }

    public function uploadProof(Request $request, Booking $booking): RedirectResponse
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($booking->payment_proof) {
            Storage::disk('public')->delete($booking->payment_proof);
        }

        $path = $request->file('payment_proof')->store('payment-proofs', 'public');

        $booking->update([
            'payment_proof' => $path,
            'payment_status' => 'paid',
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil diupload!');
    }
}
