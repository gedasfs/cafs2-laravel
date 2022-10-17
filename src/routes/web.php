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

Route::prefix('/products')->name('products.')->group(function() {
    Route::get('/', [Controllers\Products\ProductController::class, 'index'])->name('index');
    Route::get('/create', [Controllers\Products\ProductController::class, 'create'])->name('create');
    Route::get('/{product}/edit', [Controllers\Products\ProductController::class, 'edit'])->name('edit');
    Route::get('/{product}/show', [Controllers\Products\ProductController::class, 'show'])->name('show');
});

Route::prefix('/orders')->name('orders.')->group(function() {
    Route::get('/', [Controllers\Orders\OrderController::class, 'index'])->name('index');
    Route::get('/create', [Controllers\Orders\OrderController::class, 'create'])->name('create');
    Route::get('/{order}/edit', [Controllers\Orders\OrderController::class, 'edit'])->name('edit');
    Route::get('/{order}/show', [Controllers\Orders\OrderController::class, 'show'])->name('show');
});

Route::prefix('/contacts')->group(function() {
    Route::prefix('/contact-us')->name('contact-us.')->group(function() {
        Route::get('/', [Controllers\Contacts\ContactUsController::class, 'create'])->name('create');
        Route::post('/', [Controllers\Contacts\ContactUsController::class, 'store'])->name('store');
    });
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
