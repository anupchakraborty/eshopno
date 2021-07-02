<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\User;
use App\Models\Division;
use App\Models\District;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display User Profile Informations.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard()
    {
        $user = Auth::user();
        $divisions = Division::Where('id', $user->id)->first();// for show division select box
        $districts = District::Where('id', $user->id)->first(); // for show district select box
        return view('frontend.pages.users.dashboard', compact('user','divisions', 'districts'));
    }

    // show for edit user informaton
    public function profile()
    {
        $user = Auth::user();
        $divisions = Division::orderBy('priority', 'asc')->get();// for show division select box
        $districts = District::orderBy('name', 'asc')->get(); // for show district select box
        return view('frontend/pages/users/profile_edit', compact('user','divisions', 'districts'));
    }

    // edit user informaton
    public function update(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:30'],
            'last_name' => ['nullable', 'string', 'max:25'],
            'phone' => ['required', 'string', 'max:11', 'unique:users,phone,'.$user->id,],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email,'.$user->id,],
            'password' => ['required', 'string', 'min:8', 'unique:users,password,'.$user->id,],
            'street_address' => ['required', 'string', 'max:150'],
            'division_id' => ['required', 'numeric'],
            'district_id' => ['required', 'numeric'],
        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->username = Str::slug($request->first_name.$request->last_name);
        $user->street_address = $request->street_address;
        $user->shipping_address = $request->shipping_address;
        $user->division_id = $request->division_id;
        $user->district_id = $request->district_id;
        $user->ip_address = $request->ip();
        if($request->password != NULL | $request->password != "")
            $user->password = Hash::make($request->password);
        $user->save();

        session()->flash('success', 'User Profile has successfully updated');
        return back();
    }

}
