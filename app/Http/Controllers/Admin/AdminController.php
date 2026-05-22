<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Concert;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $totalConcerts = Concert::count();
        $activeConcerts = Concert::where('status', 'active')->count();
        $totalBookings = Booking::count();
        $totalUsers = User::count();
        $moneyIn = Invoice::where('type', 'incoming')->sum('amount');
        $moneyOut = Invoice::where('type', 'outgoing')->sum('amount');
        $totalRevenue = $moneyIn - $moneyOut;
        $confirmedRevenue = Booking::where('status', 'confirmed')->sum('total_price');
        $recentBookings = Booking::with(['user', 'concert'])->latest()->take(5)->get();
        $upcomingConcerts = Concert::where('date', '>=', now())->orderBy('date')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalConcerts', 'activeConcerts', 'totalBookings',
            'totalUsers', 'moneyIn', 'moneyOut', 'totalRevenue', 'confirmedRevenue', 'recentBookings', 'upcomingConcerts', 'user'
        ));
    }
}
