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
}
