<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class ExpireBookings extends Command
{
    protected $signature = 'bookings:expire';

    protected $description = 'Mark pending/confirmed bookings as expired if the concert date has passed';

    public function handle()
    {
        $expired = Booking::whereIn('status', ['pending', 'confirmed'])
            ->whereHas('concert', function ($query) {
                $query->where('date', '<', now()->today());
            })
            ->update(['status' => 'expired']);

        $this->info("{$expired} booking(s) marked as expired.");

        return Command::SUCCESS;
    }
}
