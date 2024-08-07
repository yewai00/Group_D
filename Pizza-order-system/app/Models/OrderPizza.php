<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPizza extends Model
{
    use HasFactory;
    protected $fillable = [
        'pizza_id',
        'order_id',
        'quantity',
        'price',
    ];
}
