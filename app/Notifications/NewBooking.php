<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewBooking extends Notification
{
    use Queueable;

    public Booking $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'booking_id' => $this->booking->id,
            'booking_code' => $this->booking->booking_code,
            'user_name' => $this->booking->user?->name ?? 'Unknown',
            'concert_title' => $this->booking->concert?->title ?? 'Concert',
            'quantity' => $this->booking->quantity,
            'total_price' => $this->booking->total_price,
            'message' => 'Booking baru: '.$this->booking->booking_code.' oleh '.($this->booking->user?->name ?? 'Unknown').' untuk '.($this->booking->concert?->title ?? 'Concert'),
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'booking_id' => $this->booking->id,
            'booking_code' => $this->booking->booking_code,
            'user_name' => $this->booking->user?->name ?? 'Unknown',
            'concert_title' => $this->booking->concert?->title ?? 'Concert',
            'quantity' => $this->booking->quantity,
            'total_price' => $this->booking->total_price,
            'message' => 'Booking baru: '.$this->booking->booking_code.' oleh '.($this->booking->user?->name ?? 'Unknown').' untuk '.($this->booking->concert?->title ?? 'Concert'),
        ];
    }
}
