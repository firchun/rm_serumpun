<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    static function getOrderUser($id_user)
    {
        return Self::where('id_user', $id_user)->count();
    }
    public static function getPiutang($id)
    {
        $total_price = 0;

        $order_items = OrderItem::where('id_order', $id)->get();

        $order_total_price = $order_items->sum(function ($orderItem) {
            return $orderItem->sum * $orderItem->price;
        });

        $total_price += $order_total_price;

        return $total_price;
    }
}
