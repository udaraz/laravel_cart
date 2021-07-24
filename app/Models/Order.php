<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_date', 'customer_id', 'total', 'cart', 'payment_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'customer_id');
    }

    public function billing()
    {
        return $this->hasOne(Billing::class);
    }
}
