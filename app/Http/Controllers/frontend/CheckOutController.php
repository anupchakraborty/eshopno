<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderby('priority', 'asc')->get();
        return view('frontend.pages.products.checkout', compact('payments'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'shipping_address' => 'required',
            'payment_method_id' => 'required',
            'district_id' => 'required',
            'division_id' => 'required'
        ]);
        $order = new Order();
        if(Auth::check()){
            $order->user_id = Auth::id();
        }
        $order->payment_id = $request->payment_method_id;
        if($request->payment_method_id != 1){
            if($request->transcation_id == NULL || empty($request->transcation_id)){
                session()->flash('error', 'Please give your transcation ID for your payment.');
                return back();
            }
            else{
                $order->transcation_id= $request->transcation_id;
            }
        }
        $order->ip_address= request()->ip();
        $order->phone_no= $request->phone;
        $order->name= $request->first_name .$request->last_name;
        $order->shipping_address= $request->shipping_address;
        $order->email= $request->email;
        $order->message= $request->message;
        $order->save();

        foreach(Cart::totalcarts() as $cart){
            $cart->order_id = $order->id;
            $cart->save();
        }
        //dd($order);
        session()->flash('success', 'Your order has taken!!! Plese wait admin will confirm it.');
        return redirect()->route('products');
    }
}
