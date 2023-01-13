<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'total',
        'status',
    ];

    public function details()
    {
        return $this->hasMany(DetailCart::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}