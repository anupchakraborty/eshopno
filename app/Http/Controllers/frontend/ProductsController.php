<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Brand;

class ProductsController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // In this method we are showing product in our frontend index pages------
    public function products()
    {
        $brands = Brand::orderBy('id', 'desc')->get();
    	return view('frontend.pages.products.index', compact('brands'));
    }


    // In this method we are show product in our frontend index pages-----
    public function show($product_slug)
    {
    	$product = Product::where('product_slug', $product_slug)->first(); // slug wise finding

        //dd($product);
        //$products_image = ProductImage::orderBy('product_id', 'desc')->get();
        if(!is_null($product)){

            return view('frontend.pages.products.view', compact('product'));
        }
        else{
            session()->flash('errors', 'Sorry!! This product are not aviailable');
            return redirect()->route('products');
        }
    }
}
