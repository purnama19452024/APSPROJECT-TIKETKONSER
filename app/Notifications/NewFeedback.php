<?php

namespace App\Notifications;

use App\Models\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewFeedback extends Notification
{
    use Queueable;

    public Feedback $feedback;

    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'feedback_id' => $this->feedback->id,
            'user_name' => $this->feedback->user?->name ?? 'Unknown',
            'type' => $this->feedback->type,
            'message' => 'Feedback baru: '.($this->feedback->user?->name ?? 'Unknown').' mengirim '.$this->feedback->type,
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'feedback_id' => $this->feedback->id,
            'user_name' => $this->feedback->user?->name ?? 'Unknown',
            'type' => $this->feedback->type,
            'message' => 'Feedback baru: '.($this->feedback->user?->name ?? 'Unknown').' mengirim '.$this->feedback->type,
        ];
    }
}
