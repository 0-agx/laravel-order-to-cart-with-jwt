<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'detail_cart_id',
        'item_description',
        'unit_price',
        'order_qty',
        'amount',
    ];

    public function detail_cart()
    {
        return $this->belongsTo(DetailCart::class);
    }
}
