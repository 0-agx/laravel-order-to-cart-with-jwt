<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cart_id',
        'item_id',
        'qty',
        'unit_price',
        'net_amount',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
