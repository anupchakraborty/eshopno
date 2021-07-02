<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class ShopSettingController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setting()
    {
        // if (is_null($this->user) || !$this->user->can('admin.view')) {
        //     abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        // }

        $settings = Setting::all();
        return view('backend.pages.settings.setting', compact('settings'));
    }
}
