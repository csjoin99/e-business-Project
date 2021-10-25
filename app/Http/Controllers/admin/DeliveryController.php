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

    public function update(Request $request)
    {
        try {
            $order = Order::find($request->id);
            if (!$order) {
                return response()->json([
                    'data' =>  [],
                    'message' =>  'La orden no está registrada',
                ], 400);
            }
            $errors = [];
            if ($request->shipment_status != 0 && $request->shipment_status != 1) {
                array_push($errors, 'El estado de envío no es válido.');
            }
            if ($request->status != 0 && $request->status != 1) {
                array_push($errors, 'El estado de pago no es válido.');
            }
            if (count($errors)) {
                return response()->json([
                    'data' =>  [],
                    'message' =>  implode(" ",$errors),
                ], 400);
            }
            $order->shipment_status = $request->shipment_status;
            $order->status = $request->status;
            $order->save();
            return response()->json([
                'data' =>  [
                    'data' => [],
                ],
                'message' =>  'Entrega actualizada',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'data' =>  [],
                'message' =>  'Ocurrio un error',
            ], 400);
        }
    }
}
