<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1 as ApiV1Controllers;
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

Route::prefix('v1')->group(function() {
    Route::prefix('/products')->group(function() {
        Route::get('/', [ApiV1Controllers\Products\ProductController::class, 'index']);
        Route::get('/{product}', [ApiV1Controllers\Products\ProductController::class, 'view']);
        Route::post('/store', [ApiV1Controllers\Products\ProductController::class, 'store']);
        Route::patch('/{product}/update', [ApiV1Controllers\Products\ProductController::class, 'update']);
    });

    Route::prefix('/categories')->group(function() {
        Route::get('/', [ApiV1Controllers\Categories\CategoryController::class, 'index']);
    });
});
