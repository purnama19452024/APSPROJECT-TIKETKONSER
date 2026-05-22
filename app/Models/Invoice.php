<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'type',
        'amount',
        'description',
        'invoice_date',
        'reference_type',
        'reference_id',
        'signature',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'invoice_date' => 'date',
        ];
    }

    public function reference(): MorphTo
    {
        return $this->morphTo();
    }
}
