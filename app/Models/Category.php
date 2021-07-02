<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Category extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'cat_name', 'cat_description','cat_image', 'parent_id',
    ];
    public function parent()
    {
    	return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products()
    {
    	return $this->hasMany(Product::class);
    }
}
