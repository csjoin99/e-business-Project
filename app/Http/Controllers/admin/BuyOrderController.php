<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Buy_order;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;

class BuyOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buy_order_list = Buy_order::paginate(10);
        return view('admin.buy-order.index', compact('buy_order_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = Provider::all();
        return view('admin.buy-order.create', compact('providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buy_order  $buy_order
     * @return \Illuminate\Http\Response
     */
    public function show(Buy_order $buy_order)
    {
        return view('admin.buy-order.show', compact('buy_order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buy_order  $buy_order
     * @return \Illuminate\Http\Response
     */
    public function edit(Buy_order $buy_order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buy_order  $buy_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buy_order $buy_order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buy_order  $buy_order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buy_order $buy_order)
    {
        //
    }

    public function store_buy_order(Request $request)
    {
        try {
            $data = $request->all();
            $provider = Provider::find($request->provider_id);
            if (!$provider) {
                return response()->json([
                    'error' => 'El proveedor no está registrado',
                ], 400);
            }
            $product_list = [];
            foreach (json_decode($request->product_list) as $item) {
                $product = Product::find($item->id);
                if (!$product) {
                    return response()->json([
                        'error' => 'Un producto no está registrado',
                    ], 400);
                }
                array_push($product_list, ['product' => $product, 'item' => $item]);
            }
            $data = $request->only(['num_doc', 'total', 'subtotal']);
            $data['provider_id'] = $provider->id;
            $buy_order = Buy_order::create($data);
            foreach ($product_list as $product_item) {
                $item = $product_item['item'];
                $product = $product_item['product'];
                $buy_order->product()->attach($product->id, [
                    'quantity' => $item->qty,
                    'total' => $item->real_price,
                ]);
                $product->stock = $product->stock + $item->qty;
                $product->save();
            }
            return response()->json([
                'status' => 200,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => $th->getMessage(),
                'error' => 'Ocurrio un error',
            ], 400);
        }
    }
}
