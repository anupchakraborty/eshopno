<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Division;
use App\Models\District;


class DivisionController extends Controller
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
    	$divisions = Division::orderBy('priority', 'asc')->get();
    	return view('backend.pages.divisions.index', compact('divisions'));
    }

    //add divisions-----------
    public function create()
    {
        return view('backend.pages.divisions.create');
    }

    //store divisions-----------
    Public function store(Request $request)
    {
    	$validated = $request->validate([
        'name' => 'required|max:150',
        'priority' => 'required|max:300',
    	],
    	[
    		'name.required' => 'Your Division Name',
    		'priority.required' => 'Your Division priority',
    	]);

		$division = new Division; //product model name define
    	$division->name = $request->name; //input field
    	$division->priority = $request->priority; // priority from input field

    	$division->save();

    	session()->flash('success', 'A new divisions has added successfully!!');
    	return redirect()->route('admin.division.manage');
    }

    //edit category ----------------
    public function edit($id)
    {
    	$division = Division::find($id);
    	if(!is_null($division)){
    		return view('backend.pages.divisions.edit', compact('division'));
    	}
    	else{
    		return redirect()->route('admin.division.manage');
    	}
    }

    //update category
    public function update(Request $request, $id)
    {
    	$validated = $request->validate([
        'name' => 'required|max:150',
        'priority' => 'required|max:300',
    	],
    	[
    		'name.required' => 'Your Division Name',
    		'priority.required' => 'Your Division priority',
    	]);
        $division = Division::find($id);
    	$division->name = $request->name; //catch image from input field
    	$division->priority = $request->priority; //catch image from input field

    	$division->save();

    	session()->flash('success', 'Division has Updated successfully !!');
    	return redirect()->route('admin.division.manage');
    }

    //delete brand---------------
    public function delete($id)
    {
    	$division = Division::find($id); //product model name finding this id
    	if (!is_null($division)) {

            $districts = District::where('division_id',$division->id)->get();
    		foreach ($districts as $district) {
                $district->delete();
            }
	    	$division->delete();
    	}
    	session()->flash('success', 'division has deleted successfully !!');
    	return back();
    }
}
