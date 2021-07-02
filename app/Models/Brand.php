<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Brand extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'brand_name', 'brand_description','brand_image', 'status',
    ];
    public function parent()
    {
    	return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products()
    {
    	return $this->hasMany(Category::class);
    }
}
