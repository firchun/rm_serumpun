<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderReceived extends Model
{
    use HasFactory;
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'id_order');
    }
}
