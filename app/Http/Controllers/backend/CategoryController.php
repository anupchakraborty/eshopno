<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Support\Str;
use Image;
use File;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
        if (is_null($this->user) || !$this->user->can('category.view')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any role !');
        }

    	$categories = Category::orderBy('id', 'desc')->get();
    	return view('backend.pages.category.index', compact('categories'));
    }

     //deactive_category--------

    public function deactive_category(Request $request, $id)
    {
        DB::table('categories')
                ->where('id', $id)
                ->update(['status'=> 0]);
                session()->flash('success', 'Category Status Updated !!');
                return redirect()->route('admin.category.manage');
    }

    //active_category--------
    public function active_category(Request $request, $id)
    {
        DB::table('categories')
                ->where('id', $id)
                ->update(['status'=> 1]);
                session()->flash('success', 'Category Status Updated !!');
                return redirect()->route('admin.category.manage');
    }

     //add product-----------
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('category.create')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any role !');
        }

    	$main_category = Category::orderBy('cat_name', 'desc')->where('parent_id', NULL)->get();
        return view('backend.pages.category.create', compact('main_category'));
    }

    //store product-----------
    Public function store(Request $request)
    {
    	$validated = $request->validate([
        'cat_name' => 'required|max:150',
        'cat_description' => 'required|max:300',
        'cat_image' => 'nullable|image',
    	],
    	[
    		'cat_name.required' => 'Your Category Name',
    		'cat_description.required' => 'Your Category Description',
    		'cat_image.image' => 'Your Category Image like .jpg, .png, .gif, .jpeg extension',
    	]);

		$category = new Category; //product model name define
    	$category->cat_name = $request->cat_name; //catch image from input field
        $category->cat_slug = Str::slug($request->cat_name);  //slug name define
    	$category->cat_description = $request->cat_description; //catch image from input field
    	$category->parent_id = $request->parent_id;

    	//category Image Model Insert images-------
    	if (!empty($request->cat_image)) {

    		$image = $request->file('cat_image');
    		$db_img = time() . '.' . $image->getClientOriginalExtension(); //image name define
    		$location = public_path('backend/img/category/'.$db_img); //image location define im public folder
    		Image::make($image)->save($location);
    		$category->cat_image = $db_img;
    	}
    	$category->save();

    	session()->flash('success', 'A new Category has added successfully!!');
    	return redirect()->route('admin.category.manage');
    }

    //edit category ----------------
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('category.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any role !');
        }

    	$main_category = Category::orderBy('cat_name', 'desc')->where('parent_id', NULL)->get();
    	$category = Category::find($id);
    	if(!is_null($category)){
    		return view('backend.pages.category.edit', compact('category', 'main_category'));
    	}
    	else{
    		return redirect()->route('admin.category.manage');
    	}
    }

    //update category
    public function update(Request $request, $id)
    {
    	$validated = $request->validate([
        'cat_name' => 'required|max:150',
        'cat_description' => 'required|max:300',
        'image' => 'nullable|image',
    	],
    	[
    		'cat_name.required' => 'Your Category Name',
    		'cat_description.required' => 'Your Category Description',
    		'image.image' => 'Your Category Image like .jpg, .png, .gif, .jpeg extension',
    	]);

		$category = Category::find($id); //product model name finding this id
    	$category->cat_name = $request->cat_name; //catch image from input field
    	$category->cat_description = $request->cat_description; //catch image from input field
    	$category->parent_id = $request->parent_id;

    	//category Image Model Insert images-------
    	if ( !empty($request->image))
    	{
    		// Delete the old images from folder
    		if(File::exists('backend/img/category/'.$category->cat_image))
    		{
    			File::delete('backend/img/category/'.$category->cat_image);
    		}

    		$image = $request->file('image');
    		$db_img = time() . '.' . $image->getClientOriginalExtension(); //image name define
    		$location = public_path('backend/img/category/'.$db_img); //image location define im public folder
    		Image::make($image)->save($location);
    		$category->cat_image = $db_img;
    	}
    	$category->save();

    	session()->flash('success', 'Category has Updated successfully !!');
    	return redirect()->route('admin.category.manage');
    }

    //delete category---------------
    public function delete($id)
    {
        if (is_null($this->user) || !$this->user->can('category.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any role !');
        }

    	$category = Category::find($id); //product model name finding this id
    	if (!is_null($category)) {

    		//if it is parent category then delete all sub category
    		if ($category->parent_id == NULL) {
    			// delete sub category
    			$sub_category = Category::orderBy('cat_name', 'desc')->where('parent_id', $category->id)->get(); // finding parent id wise category id for delele all sub category
    			foreach ($sub_category as $sub) {
    				//delete category image
		    		if(File::exists('backend/img/category/'.$sub->cat_image))
		    			// Check the existing image file in public path
		    		{
		    			File::delete('backend/img/category/'.$sub->cat_image);
		    		}
    				$sub->delete();
    			}
    		}

	    	//delete category image
    		if(File::exists('backend/img/category/'.$category->cat_image))
    			// Check the existing image file in public path
    		{
    			File::delete('backend/img/category/'.$category->cat_image);
    		}

    		$category->delete();
    	}
    	session()->flash('success', 'Category has deleted successfully !!');
    	return back();
    }
}
