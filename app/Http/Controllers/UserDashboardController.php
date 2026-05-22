<?php

namespace App\Http\Controllers;

use App\Models\Booking;
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

        return view('user.dashboard', compact('bookings', 'totalBookings', 'confirmedBookings', 'totalSpent'));
    }
}
