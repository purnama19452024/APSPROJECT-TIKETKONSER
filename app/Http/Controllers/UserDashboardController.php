<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Concert;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $bookings = Booking::with('concert')
            ->where('user_id', $user->id)
            ->latest()
            ->get();
        $totalBookings = $bookings->count();
        $confirmedBookings = $bookings->where('status', 'confirmed')->count();
        $totalSpent = $bookings->where('status', 'confirmed')->sum('total_price');

        $upcomingBookings = Booking::with('concert')
            ->where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->whereHas('concert', fn ($q) => $q->where('date', '>=', now()->today()))
            ->get()
            ->sortBy(fn ($b) => $b->concert?->date)
            ->take(4);

        $upcomingConcerts = Concert::active()
            ->where('date', '>=', now()->today())
            ->orderBy('date')
            ->take(4)
            ->get();

        return view('user.dashboard', compact(
            'bookings', 'totalBookings', 'confirmedBookings', 'totalSpent',
            'upcomingBookings', 'upcomingConcerts'
        ));
    }
}
