<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\Division;
use App\Models\District;
use App\Notifications\verifyRegistation;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

/*
|------------------------------
    Regisition Form display district and division
    @overright method1
|-----------------------------
*/
    public function showRegistrationForm()
    {
        $divisions = Division::orderBy('priority', 'asc')->get();// for show division select box
        $districts = District::orderBy('name', 'asc')->get(); // for show district select box
        return view('frontend.auth.register', compact('divisions', 'districts'));
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|max:30',
            'last_name' => 'nullable|max:25',
            'phone' => 'required|max:11',
            'email' => 'required|max:100',
            'password' => 'required|min:8',
            'street_address' => 'required|max:150',
            'division_id' => 'required',
            'district_id' => 'required',
        ]);
            //dd($request->all());

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->username = Str::slug($request->first_name.$request->last_name);
        $user->street_address = $request->street_address;
        $user->shipping_address = $request->shipping_address;
        $user-> division_id = $request->division_id;
        $user->district_id = $request->district_id;
        $user->ip_address = $request->ip();
        $user->remember_token = Str::random(40);
        $user->status = 0;
        $user->save();

        // dd($user);
        $user->notify(new verifyRegistation($user));

        session()->flash('success', 'A Notification email sent to you. Please check and confirmd your email');
        return redirect('/');
    }
}
