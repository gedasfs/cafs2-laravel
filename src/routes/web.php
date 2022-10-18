<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('/', [Controllers\Products\ProductController::class, 'index']);

Route::prefix('/products')->name('products.')->controller(Controllers\Products\ProductController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/{product}/edit', 'edit')->name('edit');
    Route::get('/{product}/show', 'show')->name('show');

    Route::prefix('/filter')->name('filter.')->group(function() {
        Route::get('/by-count', 'countAll');
        Route::get('/by-count/{colName}/{colVal}/{action?}', 'countByColWithVal');
        Route::get('/by-order/{colName}/{sorting?}', 'filterByOrderWithCol');
        Route::get('/by-order/{colname}/{limit}/{sorting?}', 'filterByOrderWithColWithLimit');
    });
});

Route::prefix('/orders')->name('orders.')->controller(Controllers\Orders\OrderController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/{order}/edit', 'edit')->name('edit');
    Route::get('/{order}/show', 'show')->name('show');
});

Route::prefix('/about')->group(function() {
    Route::prefix('/contact-us')->name('contact-us.')->controller(Controllers\About\ContactUsController::class)->group(function() {
        Route::get('/', 'create')->name('create');
        Route::post('/', 'store')->name('store');
    });
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
