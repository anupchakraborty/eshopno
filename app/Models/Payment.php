<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'name', 'image', 'priority','short_name','payment_no', 'payment_type',
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
