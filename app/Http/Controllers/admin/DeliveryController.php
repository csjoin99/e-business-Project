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
        $orders = Order::where('shipment_status', 0)
            ->orWhere('status', 0)->get();
        return view('admin.delivery.index', compact('orders'));
    }
}
