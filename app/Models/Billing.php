<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id','name','address','country','province', 'zip'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
