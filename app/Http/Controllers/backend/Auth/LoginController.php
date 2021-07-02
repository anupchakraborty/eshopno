<?php

namespace App\Http\Controllers\backend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\verifyRegistation;

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
    protected $redirectTo = RouteServiceProvider::ADMIN_DASHBOARD;

    /**
     * Protecd to guard.
     *
     * @return void
     */
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    /**
     * show login form for admin guard
     *
     * @return void
     */
    public function login(Request $request)
    {
       // Validate Login Data
       $request->validate([
        'email' => 'required|max:50',
        'password' => 'required',
    ]);

    // Attempt to login
    if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
           // Redirect to dashboard
            $notification = array(
            'message' => 'Successully Logged in !',
            'alert-type' => 'success'
            );
             return redirect()->intended(route('admin.dashboard'))->with($notification);
        }
        else {
            // Search using username
            if (Auth::guard('admin')->attempt(['username' => $request->email, 'password' => $request->password], $request->remember)) {
                $notification = array(
                    'message' => 'Successully Logged in !',
                    'alert-type' => 'success'
                );
                return redirect()->intended(route('admin.dashboard'))->with($notification);
            }
            $notification = array(
                'message' => 'Invalid email and password!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    /**
     * logout admin guard
     *
     * @return void
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        $notification = array(
            'message' => 'Thanks For Spending Time to Our Website!',
            'alert-type' => 'success'
            );
        return redirect()->route('admin.login')->with($notification);
    }
}
