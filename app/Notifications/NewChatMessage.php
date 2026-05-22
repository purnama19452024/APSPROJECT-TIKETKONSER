<?php

namespace App\Notifications;

use App\Models\Chat;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewChatMessage extends Notification
{
    use Queueable;

    public Chat $chat;

    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'chat_id' => $this->chat->id,
            'user_id' => $this->chat->user_id,
            'user_name' => $this->chat->user?->name ?? 'Unknown',
            'message' => 'Pesan baru dari '.($this->chat->user?->name ?? 'Unknown').': '.$this->chat->message,
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'chat_id' => $this->chat->id,
            'user_id' => $this->chat->user_id,
            'user_name' => $this->chat->user?->name ?? 'Unknown',
            'message' => 'Pesan baru dari '.($this->chat->user?->name ?? 'Unknown').': '.$this->chat->message,
        ];
    }
}
