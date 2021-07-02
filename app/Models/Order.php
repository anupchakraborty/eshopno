<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Order extends Model
{
    use Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'ip_address', 'phone_no','name','shipping_address', 'email', 'message','is_paid', 'is_completed','is_seen_by_admin',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function carts(){
        return $this->belongsTo(Cart::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }
}
