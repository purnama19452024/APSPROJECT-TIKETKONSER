<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function index(): View
    {
        $users = User::whereHas('chats')->withCount(['chats' => function ($q) {
            $q->where('sender', 'user')->where('is_read', false);
        }])->get();

        return view('admin.chats.index', compact('users'));
    }

    public function show(User $user): View
    {
        $messages = Chat::where('user_id', $user->id)
            ->orderBy('created_at')
            ->get();

        Chat::where('user_id', $user->id)
            ->where('sender', 'user')
            ->update(['is_read' => true]);

        return view('admin.chats.show', compact('user', 'messages'));
    }

    public function reply(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'message' => 'required_without:image|string|nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'user_id' => $user->id,
            'message' => $request->message ?? '',
            'sender' => 'admin',
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('chat-images', 'public');
        }

        Chat::create($data);

        return back()->with('success', 'Pesan terkirim!');
    }
}
