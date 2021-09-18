<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add_item(Request $request)
    {
        $product = Product::find($request->id);
        $cart = Cart::search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        })->first();
        if ($cart) {
            $qty = $cart->qty + 1;
        } else {
            $qty = 1;
        }
        if ((int)$product->stock < (int)$qty)
            return response()->json([
                'message' => 'La cantidad solicitada sobrepasa al stock actual'
            ], 400);
        if ($cart) {
            Cart::update($cart->rowId, $qty);
        } else {
            Cart::add($product->id, $product->name, 1, $product->real_price);
        }
        return response()->json([
            'data' => Cart::content(),
            'total_items' => Cart::count(),
        ], 200);
    }
}
