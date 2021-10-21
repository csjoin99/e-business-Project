<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Traits\CheckoutTraits;

class CartController extends Controller
{
    use CheckoutTraits;
    
    public function add_item(Request $request)
    {
        try {
            $this->check_sessions();
            $item_qty = isset($request->qty) ? $request->qty : 1;
            $product = Product::find($request->id);
            $cart = Cart::search(function ($cartItem, $rowId) use ($product) {
                return $cartItem->id === $product->id;
            })->first();
            if ($cart) {
                $qty = $cart->qty + $item_qty;
            } else {
                $qty = $item_qty;
            }
            if ((int)$product->temp_stock < (int)$qty)
                return response()->json([
                    'message' => 'La cantidad solicitada sobrepasa al stock actual'
                ], 400);
            if ($cart) {
                Cart::update($cart->rowId, $qty);
            } else {
                Cart::add($product->id, $product->name, $item_qty, $product->real_price, [
                    'category' => $product->category->name,
                    'stock' => $product->stock,
                    'image' => $product->product_photo->count() ? $product->product_photo->first()->image : 'https://e7.pngegg.com/pngimages/709/358/png-clipart-price-toyservice-soil-business-no-till-farming-no-rectangle-pie.png'
                ]);
            }
            $order = $this->calculate_order();
            return response()->json([
                'cart' => Cart::content(),
                'total_items' => Cart::count(),
                'order' => $order,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Ocurrio un error'
            ], 400);
        }
    }

    public function get_cart_content()
    {
        try {
            $coupon = session()->get('coupon');
            $order = $this->calculate_order();
            return response()->json([
                'cart' => Cart::content(),
                'total_items' => Cart::count(),
                'coupon' => $coupon,
                'order' => $order,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Ocurrio un error'
            ], 400);
        }
    }

    public function update_item(Request $request)
    {
        try {
            $this->check_sessions();
            $product = Product::find($request->id);
            $cart = Cart::search(function ($cartItem, $rowId) use ($product) {
                return $cartItem->id === $product->id;
            })->first();
            if ((int)$product->temp_stock < (int)$request->qty)
                return response()->json([
                    'message' => 'La cantidad solicitada sobrepasa al stock actual'
                ], 400);
            $cart = Cart::update($cart->rowId, $request->qty);
            $cart->subtotal = number_format(((float)$cart->qty * (float)$cart->price), 2, '.', '');
            $order = $this->calculate_order();
            return response()->json([
                'data' => $cart,
                'total_items' => Cart::count(),
                'order' => $order,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Ocurrio un error'
            ], 400);
        }
    }

    public function delete_item(Request $request)
    {
        try {
            $this->check_sessions();
            Cart::remove($request->rowId);
            $order = $this->calculate_order();
            return response()->json([
                'message' => 'Item eliminado',
                'total_items' => Cart::count(),
                'cart_content' => Cart::content(),
                'order' => $order,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Ocurrio un error'
            ], 400);
        }
    }

    public function get_coupon(Request $request)
    {
        try {
            $coupon = Coupon::where('code', $request->code)->first();
            if (!$coupon) {
                session()->forget('coupon');
                $order = $this->calculate_order();
                return response()->json([
                    'message' => 'No hay cupón con este código',
                    'order' => $order,
                ], 400);
            }
            session()->put('coupon', $coupon);
            $order = $this->calculate_order();
            return response()->json([
                'coupon' => $coupon,
                'order' => $order,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Ocurrio un error',
            ], 400);
        }
    }

    public function calculate_order()
    {
        $subtotal = Cart::subtotal();
        $coupon = session()->has('coupon') ? session()->get('coupon') : null;
        if ($coupon) {
            if ($coupon->type === 'Fijo') {
                $discount = number_format($coupon->discount, 2, '.', '');
            } else {
                $discount = number_format($subtotal * $coupon->discount / 100, 2, '.', '');
            }
        } else {
            $discount = 0;
        }
        $total = number_format($subtotal - $discount + 10, 2, '.', '');
        session()->put('order',[
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
        ]);
        return [
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
        ];
    }
}
