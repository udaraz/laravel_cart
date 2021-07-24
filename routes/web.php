<?php

use App\Http\Controllers\BackOffice\AdminController;
use App\Http\Controllers\BackOffice\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\RoleController;
use Illuminate\Support\Facades\Route;


//Back office routes
Route::prefix('/admin')->name('admin.')->group(function () {
    Route::namespace('BackOffice\Auth')->group(function () {

        //Login Routes
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login']);
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    });

    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/create', [AdminController::class, 'adminCreate'])->name('create');
        Route::post('/store', [AdminController::class, 'store'])->name('store');

        Route::resource('product', ProductController::class);
        Route::get('/products/manage', [ProductController::class, 'manage'])->name('products.manage');
        Route::get('/products/product/delete/{id}', [ProductController::class, 'destroy'])->name('products.product.delete');

        Route::get('/products/image/delete/{id}', [ProductController::class, 'imageDestroy'])->name('products.image.delete');
        Route::get('orders', [OrderController::class, 'orders'])->name('orders.view');
        Route::get('order/{id}', [OrderController::class, 'show'])->name('order.view');
        Route::resource('roles', RoleController::class);
    });

});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.single.view');

Route::group(['middleware' => ['auth:web']], function () {
    //cart
    Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::patch('update-cart', [CartController::class, 'update'])->name('cart.update');
    Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('cart.destroy');

    //checkout
    Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');

    //place order
    Route::post('order-proceed', [OrderController::class, 'store'])->name('order.proceed');
    Route::get('orders', [OrderController::class, 'orderByUser'])->name('order.view');
});

