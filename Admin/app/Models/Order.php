<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'notes',
        'minus_point',
        'discount',
        'discount',
        'price_total',
        'status',
    ];

    public function user()
    {
        return $this->belongsto(User::class, 'user_id');
    }
}
