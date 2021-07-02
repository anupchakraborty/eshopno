<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class PagesController extends Controller
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

    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        $brands = Brand::orderBy('id', 'desc')->get();
    	return view('frontend.index', compact('brands'));
    }

    public function products_search(Request $request)
    {
        $products_search = $request->search;
        $products = Product::orWhere('product_title', 'like', '%'.$products_search.'%')
                            ->orWhere('product_description', 'like', '%'.$products_search.'%')
                            ->orWhere('product_slug', 'like', '%'.$products_search.'%')
                            ->orWhere('sell_price', 'like', '%'.$products_search.'%')
                            ->orWhere('quantity', 'like', '%'.$products_search.'%')
                            ->orderBy('id', 'desc')
                            ->paginate(9);
        return view('frontend.pages.products.search', compact('products_search', 'products'));
    }
}
