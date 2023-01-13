<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'unit_price',
        'item_category_id',
        'store_id',
    ];

    public function item_category()
    {
        return $this->belongsTo(ItemCategory::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
