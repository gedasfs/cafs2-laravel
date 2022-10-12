<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPaymentType extends Model
{
    use HasFactory;

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
