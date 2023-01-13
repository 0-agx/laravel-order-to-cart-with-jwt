<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cart_id',
        'customer_name',
        'shipping_address',
        'expedition',
        'order_amount',
        'shipping_price',
        'net_amount',
        'status',
    ];

    public function detail_order()
    {
        return $this->hasMany(DetailOrder::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
