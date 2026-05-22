<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::with('user')
            ->where('status', 'active')
            ->latest()
            ->paginate(15);

        return view('user.announcements', compact('announcements'));
    }
}
