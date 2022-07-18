<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',
        'phone',
        'country',
        'district',
        'shipAdreess',
        'orderQuantity',
        'orderPrice',
        'shipmentCost',
        'totalPrice',
        'deliveryMethod',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Order_Detail::class);
    }
}
