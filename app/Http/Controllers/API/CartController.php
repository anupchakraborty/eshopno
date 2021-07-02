<?php

namespace App\Http\Controllers\API;

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

        return json_encode(['status'=>'success', 'Message'=>'Item Added','totalItems'=> Cart::totalItems()]);
    }

}
