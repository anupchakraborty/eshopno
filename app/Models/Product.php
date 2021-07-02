<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Product extends Authenticatable
{
	use Notifiable, HasRoles;

    protected $fillable = [
        'product_title', 'category_id','brand_id','product_description','quantity', 'sell_price','buy_price', 'status','offer_price','product_color', 'product_size',
    ];
    public function images()
	{
		return $this->hasmany(ProductImage::class);
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}

}
