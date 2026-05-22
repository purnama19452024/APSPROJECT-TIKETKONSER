<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    public function index(): View
    {
        $feedbacks = Feedback::with('user')->latest()->paginate(15);

        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    public function show(Feedback $feedback): View
    {
        $feedback->load('user');

        return view('admin.feedbacks.show', compact('feedback'));
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return back()->with('success', 'Feedback berhasil dihapus!');
    }
}
