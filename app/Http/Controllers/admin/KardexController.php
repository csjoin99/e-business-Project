<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Buy_order;
use App\Models\Kardex;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class KardexController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('admin.kardex.index', compact('products'));
    }

    public function check_kardex(Request $request)
    {
        try {
            $product = Product::find($request->product);
            if (!$product) {
                return response()->json([
                    'message' => 'El producto no existe',
                    'data' => []
                ], 400);
            }
            $get_date = function ($value) {
                $date = trim($value);
                return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
            };
            $range_date = array_map($get_date, explode('-', $request->range_date));
            $date_start = $range_date[0];
            $date_end = $range_date[1];
            $kardex = Kardex::where('product_id', $product->id)
                ->where('created_at', '>=', $date_start)
                ->where('created_at', '<=', $date_end)
                ->get();
            return response()->json([
                'message' => 'Data de kardex',
                'data' => $kardex
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Ocurrio un error' . $th->getMessage(),
                'data' => [],
            ], 400);
        }
    }
}
