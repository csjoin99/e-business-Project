<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Buy_order;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function report_product()
    {
        $products = Product::get();
        return view('admin.report.report-product', compact('products'));
    }

    public function api_report_product(Request $request)
    {
        try {
            $product = Product::find($request->product);
            if (!$product) {
                return response()->json([
                    'message' => 'El producto no existe',
                    'data_sum' => [],
                    'data_label' => [],
                    'test' => '',
                ], 400);
            }
            $get_date = function ($value) {
                $date = trim($value);
                return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
            };
            $range_date = array_map($get_date, explode('-', $request->date));
            $date_start = $range_date[0];
            $date_end = $range_date[1];
            $order = Order::select([
                DB::raw("sum([order].[total]) as sum_total"),
                DB::raw("CONCAT(MONTH([order].[created_at]),'-',YEAR([order].[created_at])) as date"),
                DB::raw("MONTH([order].[created_at]) as month"),
                DB::raw("YEAR([order].[created_at]) as year"),
            ])
                ->join('order_detail', 'order_detail.order_id', '=', 'order.id')
                ->where('order_detail.product_id', $product->id)
                ->where('order.created_at', '>=', $date_start)
                ->where('order.created_at', '<=', $date_end)
                ->groupBy(DB::raw("MONTH([order].[created_at])"))
                ->groupBy(DB::raw("YEAR([order].[created_at])"))->get();
            $buy_order = Buy_order::select([
                DB::raw("sum([buy_order].[total]) as sum_total"),
                DB::raw("CONCAT(MONTH([buy_order].[created_at]),'-',YEAR([buy_order].[created_at])) as date"),
                DB::raw("MONTH([buy_order].[created_at]) as month"),
                DB::raw("YEAR([buy_order].[created_at]) as year"),
            ])
                ->join('buy_order_detail', 'buy_order_detail.buy_order_id', '=', 'buy_order.id')
                ->where('buy_order_detail.product_id', $product->id)
                ->where('buy_order.created_at', '>=', $date_start)
                ->where('buy_order.created_at', '<=', $date_end)
                ->groupBy(DB::raw("MONTH([buy_order].[created_at])"))
                ->groupBy(DB::raw("YEAR([buy_order].[created_at])"))->get();
            $start    = (new DateTime($date_start))->modify('first day of this month');
            $end      = (new DateTime($date_end))->modify('first day of next month');
            $interval = DateInterval::createFromDateString('1 month');
            $period   = new DatePeriod($start, $interval, $end);
            $month_list = [];
            $order_sum_list = [];
            $buy_order_sum_list = [];
            foreach ($period as $month) {
                $month_order = $order->where('month', $month->format("m"))->where('year', $month->format("Y"))->first();
                $month_buy_order = $buy_order->where('month', $month->format("m"))->where('year', $month->format("Y"))->first();
                array_push($month_list, $month->format("m-Y"));
                array_push($order_sum_list, $month_order ? number_format($month_order->sum_total, 2, '.', '') : number_format(0, 2, '.', ''));
                array_push($buy_order_sum_list, $month_buy_order ? number_format($month_buy_order->sum_total, 2, '.', '') : number_format(0, 2, '.', ''));
            }
            return response()->json([
                'message' => 'Reporte generado',
                'data_order_sum' => $order_sum_list,
                'data_buy_order_sum' => $buy_order_sum_list,
                'data_label' => $month_list,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Ocurrio un error' . $th->getMessage(),
                'data_sum' => [],
                'data_label' => [],
                'test' => '',
            ], 400);
        }
    }
}
