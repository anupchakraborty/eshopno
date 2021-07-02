<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Division extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name', 'priority',
    ];

    public function districts()
    {
    	return $this->hasMany(District::class);
    }
}
