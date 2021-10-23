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
        $categories = Category::all();
        if (isset($request->categoria)) {
            $category = Category::where('slug', $request->categoria)->first();
            $products = Product::where('category_id', $category->id)->get();
        } else {
            $products = Product::all();
        }
        $total = $products->count() === 1 ? "{$products->count()} Artículo" : "{$products->count()} Artículos";
        return view('web.store.index', compact('products', 'categories', 'total'));
    }

    public function product_detail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $recommended_products = Product::where('category_id', $product->category_id);
        if (!$recommended_products->count()) {
            $recommended_products = Product::select('*');
        }
        $recommended_products = $recommended_products->where('id', '!=', $product->id)->get()->take(9);
        return view('web.product-detail.index', compact('product', 'recommended_products'));
    }

    public function shopping_cart()
    {
        return view('web.shopping-cart.index');
    }
}
