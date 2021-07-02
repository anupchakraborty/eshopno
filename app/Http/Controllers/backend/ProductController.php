<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Image;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    //manage product-----------
    public function index()
    {
        $manage_products = DB::table('products')
                                    ->join('categories','products.category_id','=','categories.id')
                                    ->join('brands','products.brand_id','=','brands.id')
                                    ->select('products.*','categories.cat_name','brands.brand_name')
                                    ->get();
        return view('backend.pages.products.manage')->with('manage_products', $manage_products);
    }
     //add product-----------
    public function create()
    {
        $main_category = Category::orderBy('cat_name', 'desc')->where('status', 1)->get();
        $main_brand = Brand::orderBy('brand_name', 'desc')->where('status', 1)->get();
        return view('backend.pages.products.create', compact('main_category','main_brand'));
    }

    //deactive_category--------
    public function deactive_product(Request $request, $id)
    {
        DB::table('products')
                ->where('id', $id)
                ->update(['status'=> 0]);
                session()->flash('success', 'Product Status Updated !!');
                $notification = array(
                    'message' => 'Product Status Updated !!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.product.manage')->with($notification);
    }

    //active_category--------
    public function active_product(Request $request, $id)
    {
        DB::table('products')
                ->where('id', $id)
                ->update(['status'=> 1]);

                $notification = array(
                    'message' => 'Product Status Updated !!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.product.manage')->with($notification);
    }

    //store product-----------
    Public function store(Request $request)
    {
    	$validated = $request->validate([
        'product_title' => 'required|max:255',
        'quantity' => 'required|numeric',
        'sell_price' => 'required|numeric',
        'buy_price' => 'required|numeric',
        'category_id' => 'required|numeric',
        'brand_id' => 'required|numeric',
    	]);


    	$product = new Product; //product model name define
    	$product->product_title = $request->product_title; //catch image from input field
    	$product->product_description = $request->product_description; //catch image from input field
    	$product->quantity = $request->quantity;
    	$product->sell_price = $request->sell_price;
    	$product->buy_price = $request->buy_price;
    	$product->product_slug = Str::slug($request->product_title);  //slug name define
    	$product->category_id = $request->category_id; //forien key id define
    	$product->brand_id = $request->brand_id; //forien key id define
        $product->status = $request->status;
        $product->product_color = $request->product_color;
        $product->product_size = $request->product_size;
    	$product->admin_id = 1; //forien key id define
    	$product->save(); //data save db command

    	//ProductImage Model Insert images-------
    	if (count($request->product_image) > 0) {
    		foreach ($request->product_image as $image) {   //catch multiple image from input field

	    		// Image store in public folder------
	    		//$image = $request->file('product_image'); //catch image from input field
	    		$db_img = time(). '.' .$image->getClientOriginalExtension(); //image name define
	    		$location = public_path('backend/img/products/'.$db_img); //image location define im public folder

	    		Image::make($image)->save($location);

	    		// Image store in database---
	    		$product_image = new ProductImage; //productimage model name define
	    		$product_image->product_id = $product->id;
	    		$product_image->image = $db_img; //image name save in db
	    		$product_image->save(); //data save db command

	    	}
    	}

        $notification = array(
            'message' => 'A new Product has added successfully !!',
            'alert-type' => 'success'
        );
    	return redirect()->route('admin.product.create')->with($notification);
    }

    //view product-----
    public function view($id)
    {
    	$view = DB::table('products')->where('id',$id)->first();
    	return view('backend.pages.products.view', compact('view'));
    }

    //edit product-----
    public function edit($id)
    {
        $main_category = Category::orderBy('cat_name', 'desc')->where('status', 1)->get();
        $main_brand = Brand::orderBy('brand_name', 'desc')->where('status', 1)->get();
        $prod_edit = Product::find($id);
        if(!is_null($prod_edit)){
            return view('backend.pages.products.edit', compact('prod_edit', 'main_category', 'main_brand'));
        }
        else{
            return redirect()->route('admin.product.manage');
        }
    }

    //update product-----
    public function update(Request $request, $id)
    {
    	$validated = $request->validate([
        'product_title' => 'required|max:255',
        'quantity' => 'required|numeric',
        'sell_price' => 'required|numeric',
        'buy_price' => 'required|numeric',
        'category_id' => 'required|numeric',
        'brand_id' => 'required|numeric',
        ]);

        $product = Product::find($id); //product model name define
        $product->product_title = $request->product_title; //catch image from input field
        $product->product_description = $request->product_description; //catch image from input field
        $product->quantity = $request->quantity;
        $product->sell_price = $request->sell_price;
        $product->buy_price = $request->buy_price;
        $product->product_slug = Str::slug($request->product_title);  //slug name define
        $product->category_id = $request->category_id; //forien key id define
        $product->brand_id = $request->brand_id; //forien key id define
        $product->product_color = $request->product_color;
        $product->product_size = $request->product_size;
        $product->admin_id = 1; //forien key id define
        $product->save(); //data save db command

        $notification = array(
            'message' => 'A new Product has updated successfully !!',
            'alert-type' => 'success'
        );
    	return redirect()->route('admin.product.manage')->with($notification);
    }
    //delete product-----
    public function delete(Request $request, $id)
    {
        $product = Product::find($id); //product model name finding this id
        $product->delete();
		//$product_delete = DB::table('products')->where('id',$id)->first();
        //$delete = DB::table('products')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Product has Deleted Successfully !!',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
