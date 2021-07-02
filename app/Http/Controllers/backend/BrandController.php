<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;
use Illuminate\Support\Str;
use Image;
use File;

class BrandController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    public function index()
    {
        //Role Base Authentication Permision create
        if (is_null($this->user) || !$this->user->can('brands.view')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any role !');
        }

    	$brands = Brand::orderBy('id', 'desc')->get();
    	return view('backend.pages.brands.index', compact('brands'));
    }

     //deactive_category--------

    public function deactive_brand(Request $request, $id)
    {
        DB::table('brands')
                ->where('id', $id)
                ->update(['status'=> 0]);
                session()->flash('success', 'Brands Status Updated !!');
                return redirect()->route('admin.brand.manage');
    }

    //active_category--------
    public function active_brand(Request $request, $id)
    {
        DB::table('brands')
                ->where('id', $id)
                ->update(['status'=> 1]);
                session()->flash('success', 'Brands Status Updated !!');
                return redirect()->route('admin.brand.manage');
    }


     //add brands-----------
    public function create()
    {
        //Role Base Authentication Permision create
        if (is_null($this->user) || !$this->user->can('brands.create')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any role !');
        }

        return view('backend.pages.brands.create');
    }

    //store brands-----------
    Public function store(Request $request)
    {
    	$validated = $request->validate([
        'brand_name' => 'required|max:150',
        'brand_description' => 'required|max:300',
        'brand_image' => 'nullable|image',
    	],
    	[
    		'brand_name.required' => 'Your Brand Name',
    		'brand_description.required' => 'Your Brand Description',
    		'brand_image.image' => 'Your Brand Image like .jpg, .png, .gif, .jpeg extension',
    	]);

		$brand = new Brand; //product model name define
    	$brand->brand_name = $request->brand_name; //catch image from input field
        $brand->brand_slug = Str::slug($request->brand_name);  //slug name define
    	$brand->brand_description = $request->brand_description; //catch image from input field
    	$brand->status = $request->status;

    	//category Image Model Insert images-------
    	if (!empty($request->brand_image)) {

    		$image = $request->file('brand_image');
    		$db_img = time() . '.' . $image->getClientOriginalExtension(); //image name define
    		$location = public_path('backend/img/brands/'.$db_img); //image location define im public folder
    		Image::make($image)->save($location);
    		$brand->brand_image = $db_img;
    	}
    	$brand->save();

    	$notification = array(
            'message' => 'Brand has been created !!',
            'alert-type' => 'success'
        );
    	return redirect()->route('admin.brand.manage')->with($notification);
    }

    //edit category ----------------
    public function edit($id)
    {
        //Role Base Authentication Permision create
        if (is_null($this->user) || !$this->user->can('brands.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any role !');
        }

    	$brand = Brand::find($id);
    	if(!is_null($brand)){
    		return view('backend.pages.brands.edit', compact('brand'));
    	}
    	else{
    		return redirect()->route('admin.brand.manage');
    	}
    }

    //update category
    public function update(Request $request, $id)
    {
    	$validated = $request->validate([
        'brand_name' => 'required|max:150',
        'brand_description' => 'required|max:300',
        'brand_image' => 'nullable|image',
    	],
    	[
    		'brand_name.required' => 'Your Brand Name',
    		'brand_description.required' => 'Your Brand Description',
    		'brand_image.image' => 'Your Brand Image like .jpg, .png, .gif, .jpeg extension',
    	]);

		$brand = new Brand; //product model name define
    	$brand->brand_name = $request->brand_name; //catch image from input field
    	$brand->brand_description = $request->brand_description; //catch image from input field

    	//category Image Model Insert images-------
    	if ( !empty($request->image))
    	{
    		// Delete the old images from folder
    		if(File::exists('backend/img/brands/'.$brand->brand_image))
    		{
    			File::delete('backend/img/brands/'.$brand->brand_image);
    		}

    		$image = $request->file('image');
    		$db_img = time() . '.' . $image->getClientOriginalExtension(); //image name define
    		$location = public_path('backend/img/brands/'.$db_img); //image location define im public folder
    		Image::make($image)->save($location);
    		$brand->brand_image = $db_img;
    	}
    	$brand->save();

    	$notification = array(
            'message' => 'Brand has been updated !!',
            'alert-type' => 'success'
        );
    	return redirect()->route('admin.brand.manage')->with($notification);
    }

    //delete brand---------------
    public function delete($id)
    {
        //Role Base Authentication Permision create
        if (is_null($this->user) || !$this->user->can('brands.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any role !');
        }

    	$brand = Brand::find($id); //product model name finding this id
    	if (!is_null($brand)) {

	    	//delete brand image
    		if(File::exists('backend/img/brands/'.$brand->brand_image))
    			// Check the existing image file in public path
    		{
    			File::delete('backend/img/brands/'.$brand->brand_image);
    		}

    		$brand->delete();
    	}
    	$notification = array(
            'message' => 'Brand has been deleted!!',
            'alert-type' => 'success'
        );
    	return back()->with($notification);
    }
}
