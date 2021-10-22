<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $orders = Order::where('shipment_status', 3)
            ->where('status', 2)->get();
        /* $current_date = Carbon::now();
        dd($current_date->gt($orders->last()->shipment_date), $orders->last()->shipment_date); */
        return view('admin.delivery.index', compact('orders'));
    }
}
