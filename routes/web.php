<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::prefix('adminpannel')->middleware(['admin'])->group(function () {
    Route::get('/', [AdminController::class, 'showPannel'])->middleware(['admin'])->name('adminpannel');
    Route::resource('users', UserController::class)->except(['show'])->middleware(['admin']);
    Route::resource('products', ProductController::class)->middleware(['admin']);
    Route::resource('orders', OrderController::class)->middleware(['admin']);
});
