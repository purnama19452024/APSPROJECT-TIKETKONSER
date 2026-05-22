<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\User;
use App\Notifications\NewFeedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    public function create(): View
    {
        return view('user.feedback');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'type' => 'required|in:kritik,saran,lainnya',
            'message' => 'required|string|min:3',
        ]);

        $feedback = Feedback::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'message' => $request->message,
        ]);

        User::whereIn('role', ['admin', 'supervisor'])->get()->each->notify(new NewFeedback($feedback));

        return back()->with('success', 'Terima kasih! Kritik/saran Anda telah kami terima.');
    }
}
