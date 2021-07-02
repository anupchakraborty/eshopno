<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //echo "okk";
        return view('frontend.pages.products.carts');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required'
        ],
        [
            'product_id.required' => 'Please Selcet Any product First !'
        ]);

        if(!empty($request->user_id)){
        $cart = Cart::where('user_id', $request->user_id)
                    ->where('product_id', $request->product_id)
                    ->where('order_id', NULL)
                    ->first();
        }else{
            $cart = Cart::where('ip_address', request()->ip())
                    ->where('product_id', $request->product_id)
                    ->where('order_id', NULL)
                    ->first();

        }

        if(!is_null($cart)){
            $cart->increment('product_quantity');
        }
        else{
            $cart = new Cart();
            if(!empty($request->user_id)){
                $cart->user_id = $request->user_id;
            }
            $cart->ip_address = request()->ip();
            $cart->product_id = $request->product_id;
            $cart->save();
        }

        session()->flash('success', 'This product are added to cart');
        return back();
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);

        if(!is_null($cart)){
            $cart->product_quantity = $request->product_quantity;
            $cart->save();
        }else{
            return redirect()->route('carts');
        }
        session()->flash('success', 'Cart product updated successfully');
        return back();
    }

    public function destory($id)
    {
        $cart = Cart::find($id);

        if(!is_null($cart)){
            $cart->delete();
        }else{
            return redirect()->route('carts');
        }
        session()->flash('error', 'Cart product Deleted successfully');
        return back();
    }

}
