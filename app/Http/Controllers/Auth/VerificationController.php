<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

use App\Models\User;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function verify($token)
    {
        $user = User::where('remember_token', $token)->first();
        if(!is_null($user)){
            $user->status = 1;
            $user->email_verified_at = $user->created_at;
            $user->remember_token = NULL;
            $user->save();
            session()->flash('success', 'Your registation has successful !! Login Now');
            return redirect('login');
        }
        else{
            session()->flash('errors', 'Sorry!! Your token is not matched.');
            return redirect('/');
        }
    }
}
