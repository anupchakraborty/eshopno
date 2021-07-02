<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
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
        if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view dashboard !');
        }

        // $total_admin = count(Admin::select('id')->get());
        // $total_user = count(User::select('id')->get());
        // $total_poll = count(Poll::select('id')->get());
        // $total_question = count(Question::select('id')->get());

        return view('backend.pages.dashboard.index');
    }
}
