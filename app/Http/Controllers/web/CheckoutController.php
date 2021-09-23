<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CheckoutController extends Controller
{
    public function checkout()
    {
        if(!count(Cart::content())){
            return redirect()->route('shopping.cart');
        }
        $path = public_path() . "\data\distritos.json";
        if(!File::exists($path)){
            return redirect()->route('shopping.cart');
        }
        $districts = collect(json_decode(file_get_contents($path), true));
        $districts = $districts->only('3927')->first();
        return view('web.checkout.index',compact('districts'));
        /* 3927 */
    }

    public function checkout_post(Request $request)
    {
        dd($request->all());
    }
}
