<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'id_order');
    }
    public static function getPiutang($id)
    {
        $total_price = 0;

        $orders = Order::where('id_user', $id)
            ->whereNotIn('id', function ($query) {
                $query->select('id_order')
                    ->from('order_paid_offs');
            })
            ->get();

        foreach ($orders as $order) {
            $order_items = self::where('id_order', $order->id)->get();

            $order_total_price = $order_items->sum(function ($orderItem) {
                return $orderItem->sum * $orderItem->price;
            });

            $total_price += $order_total_price;
        }

        return $total_price;
    }
}
