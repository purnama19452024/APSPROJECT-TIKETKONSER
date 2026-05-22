<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'concert_id', 'user_id', 'quantity',
        'total_price', 'payment_method', 'payment_status', 'payment_proof',
        'booking_code', 'status',
    ];

    protected function casts(): array
    {
        return [
            'total_price' => 'decimal:2',
        ];
    }

    public function concert()
    {
        return $this->belongsTo(Concert::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
