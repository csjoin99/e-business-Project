<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function store(Request $request)
    {
        if (isset($request->categoria)) {
            $category = Category::where('slug', $request->categoria)->first();
            $products = Product::where('category_id', $category->id)->get();
        } else {
            $products = Product::all();
        }
        return view('web.store.index', compact('products'));
    }

    public function product_detail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('web.product-detail.index', compact('product'));
    }

    public function shopping_cart()
    {
        return view('web.shopping-cart.index');
    }
}
