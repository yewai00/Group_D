<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    use HasFactory;
    protected $fillable = [
       'user_id',
       'rider_id'
    ];
    protected $nullable = ['rider_id'];

    public function user() {
        return $this->hasMany(User::class);  
    }
}
