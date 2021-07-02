<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class District extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name', 'division_id',
    ];
    public function division()
    {
    	return $this->belongsTo(Division::class);
    }

}
