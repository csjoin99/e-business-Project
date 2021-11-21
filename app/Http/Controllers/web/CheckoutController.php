<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Kardex;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase_session;
use App\Traits\PdfTraits;
use App\Traits\CheckoutTraits;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class CheckoutController extends Controller
{
    use CheckoutTraits;

    public function shipment_data()
    {
        if (!auth()->check()) {
            return redirect()->route('shopping.cart')->with('error', 'Debes logearte para realizar la compra');
        }
        if (!Cart::count() || !session()->has('order')) {
            return redirect()->route('shopping.cart');
        }
        $this->check_sessions();
        if (!$this->generate_session()) {
            return redirect()->route('shopping.cart')->with('error', 'La cantidad solicitada no se encuentra disponible');
        }
        $path = public_path() . "\data\distritos.json";
        if (!File::exists($path)) {
            return redirect()->route('shopping.cart');
        }
        $districts = collect(json_decode(file_get_contents($path), true));
        $districts = $districts->only('3927')->first();
        return view('web.shipment_data.index', compact('districts'));
    }

    public function store_shipment_data(Request $request)
    {
        $data = $request->except('_token');
        session()->put('shipment_data', $data);
        return redirect()->route('checkout');
    }

    public function checkout()
    {
        if (!count(Cart::content()) || !auth()->check() || !session()->has('order')) {
            return redirect()->route('shopping.cart');
        }
        $this->check_sessions();
        if (!$this->generate_session()) {
            return redirect()->route('shopping.cart')->with('error', 'La cantidad solicitada no se encuentra disponible');
        }
        if (!session()->has('shipment_data')) {
            return redirect()->route('shipment.data');
        }
        return view('web.checkout.index');
    }

    public function stripe(Request $request)
    {
        /* Stripe::setApiKey(config('services.stripe.secret'));
        $customer = Customer::create(array(
            'email' => $request->stripeEmail,
            'source'  => $request->stripeToken
        ));
        $charge = Charge::create(array(
            'customer' => $customer->id,
            'amount'   => (int)number_format(session('order.total'), 2, '', ''),
            'currency' => 'usd'
        )); */
        $shipment_data = session('shipment_data');
        $order = session('order');
        $data = array_merge($shipment_data, $order);
        $data['shipment_date'] = Carbon::createFromFormat('d-m-Y', $data['shipment_date'])->format('Y-m-d');
        $data['user_id'] = auth()->user()->id;
        if (session()->has('coupon')) {
            $coupon = session()->get('coupon');
            $data['coupon_id'] = $coupon->id;
        }
        $data['shipment_type'] = "Delivery";
        $data['shipment_price'] = 10;
        $data['shipment_status'] = 0;
        $data['status'] = 1;
        $data['total'] = $data['total'];
        $this->save_order($data);
        return redirect()->route('store')->with('purchase_message', 'Se registró su compra con exito');
    }

    public function upon_delivery(Request $request)
    {
        $shipment_data = session('shipment_data');
        $order = session('order');
        $data = array_merge($shipment_data, $order);
        $data['shipment_date'] = Carbon::createFromFormat('d-m-Y', $data['shipment_date'])->format('Y-m-d');
        $data['user_id'] = auth()->user()->id;
        if (session()->has('coupon')) {
            $coupon = session()->get('coupon');
            $data['coupon_id'] = $coupon->id;
        }
        $data['shipment_type'] = "Delivery";
        $data['shipment_price'] = 10;
        $data['shipment_status'] = 0;
        $data['status'] = 0;
        $subtotal = Cart::subtotal();
        if (isset($coupon)) {
            if ($coupon->type === 'Fijo') {
                $discount = number_format($coupon->discount, 2, '.', '');
            } else {
                $discount = number_format($subtotal * $coupon->discount / 100, 2, '.', '');
            }
        } else {
            $discount = 0;
        }
        $total = number_format($subtotal - $discount, 2, '.', '') + $data['shipment_price'];
        $data['subtotal'] = $subtotal;
        $data['discount'] = $discount;
        $data['total'] = $total;
        $this->save_order($data);
        return redirect()->route('store')->with('purchase_message', 'Se registró su compra con exito');
    }

    public function save_order($data)
    {
        $order = Order::create($data);
        $order->code = str_pad($order->id, 5, "0", STR_PAD_LEFT);
        $order->save();
        Product::disableAuditing();
        foreach (Cart::content() as $item) {
            $product = Product::find($item->id);
            Kardex::create([
                'product_id' =>  $product->id,
                'order_id' =>  $order->id,
                'total' =>  $item->price * $item->qty,
                'unit_price' =>  $item->price,
                'current_price' =>  $product->real_price,
                'init_stock' =>  $product->stock,
                'end_stock' =>  $product->stock - $item->qty,
                'quantity' =>  $item->qty
            ]);
            $order->product()->attach($item->id, [
                'quantity' => $item->qty,
                'price' => $item->price,
            ]);
            $product->stock = $product->stock - $item->qty;
            $product->save();
        }
        Product::enableAuditing();
        if ($order->coupon) {
            Coupon::disableAuditing();
            $order->coupon->stock = $order->coupon->stock - 1;
            $order->coupon->save();
            Coupon::enableAuditing();
        }
        Cart::destroy();
        if (auth()->check()) {
            $purchase_session = Purchase_session::where('user_id', auth()->user()->id)->first();
            $purchase_session->product()->delete();
            $purchase_session->delete();
        }
        session()->forget('coupon');
        session()->forget('order');
        session()->forget('shipment_data');
    }
}
