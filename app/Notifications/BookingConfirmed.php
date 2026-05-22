<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingConfirmed extends Notification
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
            'concert_title' => $this->booking->concert?->title ?? 'Concert',
            'message' => 'Pemesanan tiket '.$this->booking->booking_code.' untuk konser '.($this->booking->concert?->title ?? '').' telah dikonfirmasi!',
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'booking_id' => $this->booking->id,
            'booking_code' => $this->booking->booking_code,
            'concert_title' => $this->booking->concert?->title ?? 'Concert',
            'message' => 'Pemesanan tiket '.$this->booking->booking_code.' untuk konser '.($this->booking->concert?->title ?? '').' telah dikonfirmasi!',
        ];
    }
}
