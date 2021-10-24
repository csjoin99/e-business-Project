<?php

namespace App\Traits;

use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Purchase_session;
use App\Models\Purchase_session_product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;

trait CheckoutTraits
{
    public function generate_session()
    {
        $cart_content = [];
        foreach (Cart::content() as $item) {
            $product = Product::find($item->id);
            if ($product->temp_stock < $item->qty) {
                return false;
            }
            array_push($cart_content, ['product' => $product, 'item' => $item]);
        }
        $session = Purchase_session::where('user_id', auth()->user()->id)->first();
        if ($session) {
            $session->update([
                'date' => Carbon::now()
            ]);
        } else {
            $session_data = [
                'token' => (string)Str::uuid(),
                'user_id' => auth()->user()->id,
                'date' => Carbon::now()
            ];
            $session = Purchase_session::create($session_data);
        }
        Product::disableAuditing();
        foreach ($cart_content as $cart_item) {
            $item = $cart_item['item'];
            $product = $cart_item['product'];
            $product_session = $session->product->where('product_id', $item->id)->first();
            $temp_stock = $product->temp_stock;
            if ($product_session) {
                $product_session_data = [
                    'quantity' => $item->qty,
                ];
                $temp_stock += $product_session->quantity;
                $temp_stock -= $item->qty;
                $product_session->update($product_session_data);
            } else {
                $product_session_data = [
                    'purchase_session_id' => $session->id,
                    'product_id' => $item->id,
                    'quantity' => $item->qty,
                ];
                Purchase_session_product::create($product_session_data);
                $temp_stock -= $item->qty;
            }
            $product->update([
                'temp_stock' => $temp_stock
            ]);
        }
        Product::enableAuditing();
        return true;
    }

    public function check_sessions()
    {
        $purchase_session_list = Purchase_session::where('date', '<', Carbon::now()->subMinutes(30)->toDateTimeString());
        /* $purchase_session_list = Purchase_session::where('date', '<', Carbon::now()->subSeconds(1)->toDateTimeString()); */
        if (auth()->check()) {
            $purchase_session_list = $purchase_session_list->orWhere('user_id', auth()->user()->id);
        }
        $purchase_session_list = $purchase_session_list->get();
        foreach ($purchase_session_list as $purchase_session) {
            Product::disableAuditing();
            foreach ($purchase_session->product as $product_session) {
                $product = Product::find($product_session->product_id);
                $product->temp_stock = $product->temp_stock + $product_session->quantity;
                $product->save();
                $product_session->delete();
            }
            Product::enableAuditing();
            $purchase_session->delete();
        }
    }
}
