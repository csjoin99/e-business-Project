<?php

use App\Http\Controllers\admin\BuyOrderController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\DeliveryController;
use App\Http\Controllers\admin\KardexController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProviderController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\web\CartController;
use App\Http\Controllers\web\StoreController;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('get-coupon-data', [CouponController::class, 'get_coupon']);

Route::post('search-products', [ProductController::class, 'search_products']);

Route::post('search-products-buy-order', [ProductController::class, 'search_products_buy_order']);

Route::post('search-providers', [ProviderController::class, 'search_providers']);

Route::post('find-product-by-id', [ProductController::class, 'find_product_by_id']);

Route::post('store-cash-register', [OrderController::class, 'cash_register_store']);

Route::post('store-buy-order', [BuyOrderController::class, 'store_buy_order']);

/* Shopping cart */
Route::post('cart-add-item', [CartController::class, 'add_item']);

Route::post('get-cart-content',[CartController::class, 'get_cart_content']);

Route::post('cart-update-item',[CartController::class, 'update_item']);

Route::post('cart-delete-item',[CartController::class, 'delete_item']);

Route::post('cart-get-coupon',[CartController::class, 'get_coupon']);

/* Delivery */
Route::post('delivery-update',[DeliveryController::class, 'update']);

/* Store */
Route::post('get-products',[StoreController::class, 'api_get_products']);

/* Kardex */
Route::post('check-kardex',[KardexController::class, 'check_kardex']);

/* Report */
Route::post('report-product',[ReportController::class, 'api_report_product']);
Route::post('report-most-sold',[ReportController::class, 'api_report_most_sold']);
