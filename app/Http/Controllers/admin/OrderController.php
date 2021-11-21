<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Kardex;
use App\Models\Order;
use App\Models\Product;
use App\Models\Settings;
use App\Models\User;
use App\Traits\PdfTraits;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class OrderController extends Controller
{
    use PdfTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->search)) {
            $orders = Order::where('code', 'LIKE', "%{$request->search}%")->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        }
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        try {
            Product::disableAuditing();
            foreach ($order->product as $product) {
                Kardex::create([
                    'product_id' =>  $product->id,
                    'order_id' =>  $order->id,
                    'total' =>  $product->pivot['price'] * $product->pivot['quantity'],
                    'unit_price' =>  $product->pivot['price'],
                    'current_price' =>  $product->real_price,
                    'init_stock' =>  $product->stock,
                    'end_stock' =>  $product->stock + $product->pivot['quantity'],
                    'quantity' =>  $product->pivot['quantity']
                ]);
                $product->stock += $product->pivot->quantity;
                $product->temp_stock += $product->pivot->quantity;
                $product->save();
            }
            Product::enableAuditing();
            if ($order->coupon) {
                Coupon::disableAuditing();
                $order->coupon->stock += 1;
                $order->coupon->save();
                Coupon::enableAuditing();
            }
            $order->status = 2;
            $order->save();
            $order->delete();
            return redirect()->route('order.index')->with('success', 'Orden anulada exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('order.index')->with('failure', 'Ocurrio un error, no se pudo anular la orden' . $th->getMessage());
        }
    }

    public function cash_register_store(Request $request)
    {
        try {
            $data = $request->except('customer', '_token', 'coupon', 'product_list');
            $coupon = Coupon::where('code', $request->coupon)->first();
            if (is_numeric($request->customer)) {
                $user = User::where('id', $request->customer)->first();
                $data['user_id'] = $user->id;
            } else {
                $data['client'] = $request->customer;
            }
            if ($coupon) {
                $data['coupon_id'] = $coupon->id;
            }
            $data['shipment_date'] = date('Y-m-d');
            $data['shipment_type'] = "Presencial";
            $data['shipment_price'] = 0;
            $data['shipment_status'] = 1;
            $data['status'] = 1;
            $order = Order::create($data);
            $order->code = str_pad($order->id, 5, "0", STR_PAD_LEFT);
            $order->save();
            $product_list = [];
            foreach (json_decode($request->product_list) as $item) {
                $product = Product::find($item->id);
                if ($item->qty > $product->temp_stock) {
                    return response()->json([
                        'error' => 'La cantidad de un producto no es correcto',
                    ], 400);
                }
                array_push($product_list, ['product' => $product, 'item' => $item]);
            }
            foreach ($product_list as $product_item) {
                $item = $product_item['item'];
                $product = $product_item['product'];
                $order->product()->attach($product->id, [
                    'quantity' => $item->qty,
                    'price' => $item->price,
                ]);
                Kardex::create([
                    'product_id' =>  $product->id,
                    'order_id' =>  $order->id,
                    'total' =>  $item->real_price * $item->qty,
                    'unit_price' =>  $item->real_price,
                    'current_price' =>  $product->real_price,
                    'init_stock' =>  $product->stock,
                    'end_stock' =>  $product->stock - $item->qty,
                    'quantity' =>  $item->qty
                ]);
                Product::disableAuditing();
                $product->stock = $product->stock - $item->qty;
                $product->temp_stock = $product->temp_stock - $item->qty;
                $product->save();
                Product::enableAuditing();
            }
            if ($coupon) {
                Coupon::disableAuditing();
                $coupon->stock = $coupon->stock - 1;
                $coupon->save();
                Coupon::enableAuditing();
            }
            return response()->json([
                'status' => 200,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Ocurrio un error',
            ], 400);
        }
    }

    public function generate_order_pdf(Order $order)
    {
        return $this->generate_pdf($order);
    }
}
