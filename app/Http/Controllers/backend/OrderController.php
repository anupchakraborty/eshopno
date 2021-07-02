<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
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
        $orders = Order::orderBy('id', 'desc')->get();
        return view('backend.pages.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::find($id);
        return view('backend.pages.orders.view', compact('order'));
    }

    //admin_seen--------
    public function admin_seen(Request $request, $id)
    {
        DB::table('orders')
                ->where('id', $id)
                ->update(['is_seen_by_admin'=> 0]);

                $notification = array(
                    'message' => 'Admin Seen Status Updated !!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.order.manage')->with($notification);
    }

    //admin_unseen--------
    public function admin_unseen(Request $request, $id)
    {
        DB::table('orders')
                ->where('id', $id)
                ->update(['is_seen_by_admin'=> 1]);

                $notification = array(
                    'message' => 'Admin Seen Status Updated !!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.order.manage')->with($notification);
    }
    //paid--------
    public function paid(Request $request, $id)
    {
        DB::table('orders')
                ->where('id', $id)
                ->update(['is_paid'=> 0]);

                $notification = array(
                    'message' => 'Payment Status Updated !!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.order.manage')->with($notification);
    }

    //due--------
    public function due(Request $request, $id)
    {
        DB::table('orders')
                ->where('id', $id)
                ->update(['is_paid'=> 1]);

                $notification = array(
                    'message' => 'Payment Status Updated !!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.order.manage')->with($notification);
    }

    //Order Status--------
    public function completed(Request $request, $id)
    {
        DB::table('orders')
                ->where('id', $id)
                ->update(['is_completed'=> 0]);

                $notification = array(
                    'message' => 'Order Status Updated !!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.order.manage')->with($notification);
    }

    //Order Status--------
    public function panding(Request $request, $id)
    {
        DB::table('orders')
                ->where('id', $id)
                ->update(['is_completed'=> 1]);

                $notification = array(
                    'message' => 'Order Status Updated !!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.order.manage')->with($notification);
    }

    public function delete($id)
    {
        $order = Order::find($id); //product model name finding this id
        $order->delete();

        $notification = array(
            'message' => 'Order has Deleted Successfully !!',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
