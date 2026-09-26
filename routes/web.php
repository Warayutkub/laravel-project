<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// ตะกร้าสินค้า
Route::get('/cart/view', [CartController::class, 'viewCart']);
Route::get('/cart/add/{id}', [CartController::class, 'addToCart']);
Route::get('/cart/delete/{id}', [CartController::class, 'deleteCart']);
Route::get('/cart/update/{id}/{qty}', [CartController::class, 'updateCart']);
Route::get('/cart/checkout', [CartController::class, 'checkout']);
Route::get('/cart/complete', [CartController::class, 'complete']);
Route::get('/cart/finish', [CartController::class, 'finish_order']);

// สิทธิ์ Admin, Employee, Customer Access
Route::group(['middleware' => ['auth', 'check.level:admin,employee,customer']], function () {
    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/search', [ProductController::class, 'search']);
    Route::post('/product/search', [ProductController::class, 'search']);
    Route::get('/product/edit/{id?}', [ProductController::class, 'edit']);
    Route::post('/product/update', [ProductController::class, 'update']);
    Route::post('/product/insert', [ProductController::class, 'insert']);
    Route::get('/product/remove/{id}', [ProductController::class, 'remove']);

    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/search', [CategoryController::class, 'search']);
    Route::post('/category/search', [CategoryController::class, 'search']);
    Route::get('/category/remove/{id}', [CategoryController::class, 'remove']);
    Route::get('/category/edit/{id?}', [CategoryController::class, 'edit']);
    Route::post('/category/insert', [CategoryController::class, 'insert']);

    Route::get('/admin/orders', [OrderController::class, 'index']);
});

// เฉพาะ Admin เท่านั้น
Route::group(['middleware' => ['auth', 'check.level:admin']], function () {
    Route::get('/admin/users', [UserController::class, 'index']);
    Route::get('/users/edit/{id?}', [UserController::class, 'edit']);
    Route::post('/users/update', [UserController::class, 'update']);
});