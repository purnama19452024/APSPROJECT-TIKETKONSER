<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChatImageController extends Controller
{
    public function destroy(Chat $chat): RedirectResponse
    {
        $user = Auth::user();

        if ($chat->user_id !== $user->id && ! $user->isAdmin() && ! $user->isSupervisor()) {
            abort(403);
        }

        if ($chat->image) {
            Storage::disk('public')->delete($chat->image);
            $chat->update(['image' => null]);
        }

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}
