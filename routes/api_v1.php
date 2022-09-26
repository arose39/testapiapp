<?php

use App\Http\Controllers\Api\V1\ProductController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware('apisetlocale')
    ->group(function () {
        Route::apiResource('products',ProductController::class)
            ->only('index' , 'show')
            ->name('index','api_products.index')
            ->name('show','api_products.show');
        Route::get('products/{productId}/makeorder', [ProductController::class, 'makeOrder' ])->name('makeOrder');
    });
