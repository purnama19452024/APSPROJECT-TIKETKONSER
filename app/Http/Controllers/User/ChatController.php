<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use App\Notifications\NewChatMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $messages = Chat::where('user_id', $user->id)
            ->orderBy('created_at')
            ->get();

        return view('user.chat', compact('messages'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'message' => 'required_without:image|string|nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'user_id' => auth()->id(),
            'message' => $request->message ?? '',
            'sender' => 'user',
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('chat-images', 'public');
        }

        $chat = Chat::create($data);

        User::whereIn('role', ['admin', 'supervisor'])->get()->each->notify(new NewChatMessage($chat));

        return back()->with('success', 'Pesan terkirim!');
    }
}
