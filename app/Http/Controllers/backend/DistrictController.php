<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\District;
use App\Models\Division;

class DistrictController extends Controller
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
    	$districts = District::orderBy('name', 'asc')->get();
    	return view('backend.pages.districts.index', compact('districts'));
    }

    //add divisions-----------
    public function create()
    {
        $divisions = Division::orderBy('priority', 'asc')->get();// for show division select box
        return view('backend.pages.districts.create', compact('divisions'));
    }

    //store divisions-----------
    Public function store(Request $request)
    {
    	$validated = $request->validate([
        'name' => 'required|max:150',
        'division_id' => 'required|max:300',
    	],
    	[
    		'name.required' => 'Your Division Name',
    		'division_id.required' => 'Your Division division_id',
    	]);

		$district = new District; //product model name define
    	$district->name = $request->name; //input field
    	$district->division_id = $request->division_id; // division_id from input field

    	$district->save();


        $notification = array(
            'message' => 'District added successfully!!',
            'alert-type' => 'success'
        );
    	return redirect()->route('admin.district.create')->with($notification);
    }

    //edit category ----------------
    public function edit($id)
    {
    	$divisions = Division::orderBy('priority', 'asc')->get();// for show division select box
        $district = District::find($id);
    	if(!is_null($district)){
    		return view('backend.pages.districts.edit', compact('district', 'divisions'));
    	}
    	else{
    		return redirect()->route('admin.district.manage');
    	}
    }

    //update category
    public function update(Request $request, $id)
    {
    	$validated = $request->validate([
        'name' => 'required|max:150',
        'division_id' => 'required|max:300',
    	],
    	[
    		'name.required' => 'Your Division Name',
    		'division_id.required' => 'Your Division division_id',
    	]);

		$district = District::find($id); //product model name find
    	$district->name = $request->name; //catch image from input field
    	$district->division_id = $request->division_id; //catch image from input field

    	$district->save();


        $notification = array(
            'message' => 'District has Updated successfully !!',
            'alert-type' => 'success'
        );
    	return redirect()->route('admin.district.manage')->with($notification);
    }

    //delete brand---------------
    public function delete($id)
    {
    	$district = District::find($id); //product model name finding this id
    	if (!is_null($district)) {

	    	$district->delete();
    	}
    	session()->flash('success', 'District has deleted successfully !!');
        $notification = array(
            'message' => 'District has deleted successfully !!',
            'alert-type' => 'error'
        );
    	return back()->with($notification);
    }
}
