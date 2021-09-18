<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function store()
    {
        $products = Product::all();
        return view('web.store.index', compact('products'));
    }

    public function product_detail($slug)
    {
        $product = Product::where('slug',$slug)->first();
        return view('web.product-detail.index', compact('product'));
    }

    public function shopping_cart()
    {
        return view('web.shopping-cart.index');
    }
}
