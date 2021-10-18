<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\BuyOrderController;
use App\Http\Controllers\admin\CashRegisterController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductPhotoController;
use App\Http\Controllers\admin\ProviderController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\web\CheckoutController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\StoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('tienda', [StoreController::class, 'store'])->name('store');
Route::get('detalle-de-producto/{slug}', [StoreController::class, 'product_detail'])->name('product.detail');
Route::get('carrito-de-compra', [StoreController::class, 'shopping_cart'])->name('shopping.cart');

Route::get('datos-envio', [CheckoutController::class, 'shipment_data'])->name('shipment.data')->middleware('check_checkout_session');
Route::post('datos-envio', [CheckoutController::class, 'store_shipment_data'])->name('store.shipment.data');

Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout')->middleware('check_checkout_session');

Route::post('upon-delivery-payment', [CheckoutController::class, 'upon_delivery'])->name('upon.delivery');
Route::post('stripe-payment', [CheckoutController::class, 'stripe'])->name('stripe');

Route::get('login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'login_post'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

/* Generate order pdf */
Route::get('order/pdf/{order}', [OrderController::class, 'generate_order_pdf'])->name('generate.order.pdf');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('permission:admin.dashboard');

    Route::resource('product', ProductController::class)->middleware('permission:admin.product');
    Route::post('product/{product}/restore', [ProductController::class, 'restore'])->name('product.restore')->middleware('permission:admin.product');

    Route::resource('category', CategoryController::class)->middleware('permission:admin.category');

    Route::get('product-photo/{product}', [ProductPhotoController::class, 'index'])->name('product.photo.index')->middleware('permission:admin.product.photo');
    Route::get('product-photo/create/{product}', [ProductPhotoController::class, 'create'])->name('product.photo.create')->middleware('permission:admin.product.photo');
    Route::post('product-photo/create/{product}', [ProductPhotoController::class, 'store'])->name('product.photo.store')->middleware('permission:admin.product.photo');
    Route::get('product-photo/edit/{product_photo}', [ProductPhotoController::class, 'edit'])->name('product.photo.edit')->middleware('permission:admin.product.photo');
    Route::put('product-photo/edit/{product_photo}', [ProductPhotoController::class, 'update'])->name('product.photo.update')->middleware('permission:admin.product.photo');
    Route::delete('product-photo/destroy/{product_photo}', [ProductPhotoController::class, 'destroy'])->name('product.photo.destroy')->middleware('permission:admin.product.photo');

    Route::resource('user', UserController::class)->middleware('permission:admin.user');
    Route::post('user/{user}/restore', [UserController::class, 'restore'])->name('user.restore')->middleware('permission:admin.user');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('profile', [UserController::class, 'profile_update'])->name('profile.update');

    Route::resource('coupon', CouponController::class)->middleware('permission:admin.coupon');

    Route::resource('order', OrderController::class)->middleware('permission:admin.order');

    Route::get('cash-register', [CashRegisterController::class, 'cash_register'])->name('cash.register')->middleware('permission:admin.cash.register');

    Route::resource('provider', ProviderController::class)->middleware('permission:admin.provider');

    Route::resource('buy-order', BuyOrderController::class)->middleware('permission:admin.buy_order');

    Route::get('settings', [SettingsController::class, 'settings'])->name('settings')->middleware('permission:admin.product');
    Route::post('settings/{settings}', [SettingsController::class, 'settings_update'])->name('settings.update');
});

