<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $current_month = date('m');
        $rate_profit = $this->get_profit_rate();
        $total_products = $this->get_total_products();
        $users = User::whereMonth('created_at', $current_month)->get();
        $orders = Order::whereMonth('created_at', $current_month)->get();
        $order_bar_chart = $this->order_bar_chart();
        $product_pie_chart = $this->product_pie_chart();
        return view('admin.dashboard.index', compact('orders', 'rate_profit', 'users', 'total_products', 'order_bar_chart', 'product_pie_chart'));
    }

    private function get_profit_rate()
    {
        $current_month = date('m');
        $last_month = Carbon::now()->subMonth()->month;
        $avg_current_month = Order::whereMonth('created_at', $current_month)->avg('total');
        $avg_last_month = Order::whereMonth('created_at', $last_month)->avg('total');
        $diff = $avg_last_month - $avg_current_month;
        if ($avg_last_month > 0) {
            $avg_order_rate = ($diff / $avg_last_month) * 100;
        } else {
            $avg_order_rate = 100;
        }
        return floatval(number_format($avg_order_rate, 2));
    }

    private function get_total_products()
    {
        $current_month = date('m');
        $total_products = Order::leftJoin('order_detail', 'order_detail.order_id', '=', 'order.id')
            ->select(DB::raw('COALESCE(sum([order_detail].[quantity]),0) total'))
            ->whereMonth('order.created_at', $current_month)
            ->groupBy(DB::raw('MONTH([order].[created_at])'))
            ->get();
        return $total_products->first()->total;
    }

    private function order_bar_chart()
    {
        $days = [2 => 'Lunes', 3 => 'Martes', 4 => 'Miercoles', 5 => 'Jueves', 6 => 'Viernes', 7 => 'Sábado', 1 => 'Domingo'];
        $orders = Order::select(DB::raw('DATENAME(weekday,created_at) AS week_day'), DB::raw('DATEPART(weekday,created_at) AS week_number'))
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $fun = function ($key, $day) use ($orders) {
            return $orders->where('week_number', $key)->count();
        };
        $orders_per_day = array_map($fun, array_keys($days), $days);
        return [
            'date' => array_values($days),
            'orders_per_day' => $orders_per_day,
        ];
    }

    private function product_pie_chart()
    {
        $total_products = Order::leftJoin('order_detail', 'order_detail.order_id', '=', 'order.id')
            ->leftJoin('product', 'order_detail.product_id', '=', 'product.id')
            ->select('product.id', 'product.name', DB::raw('COALESCE(sum(order_detail.quantity),0) as total'))
            ->whereBetween('order.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('product.id', 'product.name')
            ->get();
        return [
            'products' => $total_products->pluck('name'),
            'total' => $total_products->pluck('total')
        ];
    }

    /* Function to get qty of sold products */
    /* 
    $total_products = Order::leftJoin('order_detail', 'order_detail.order_id', '=', 'order.id')
            ->leftJoin('product', 'order_detail.product_id', '=', 'product.id')
            ->select('product.id', DB::raw('COALESCE(sum(order_detail.quantity),0) as total'))
            ->whereMonth('order.created_at', $current_month)
            ->groupBy('product.id')
            ->get();
    */
}
