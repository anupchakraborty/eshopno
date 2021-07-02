<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\verifyRegistation;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();
        if($user->status == 1){
            // Login this user

            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                //login Now
                return redirect()->intended(route('index'));
            }
            else{
                session()->flash('error', 'Invalid Login !!');
                return redirect()->route('login');
            }
        }
        else{
            // send a remember token again
            if (!is_null($user)) {
                $user->notify(new verifyRegistation($user));
                session()->flash('success', 'A new Confrimation email sent to you. Please check and confirmd your email');
                return redirect('/');
            }
            else{
                session()->flash('error', 'Please Login First !!');
                return redirect()->route('login');
            }
        }
    }
}
