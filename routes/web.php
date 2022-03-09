<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductsController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){

    Route::get('/view/products', [App\Http\Controllers\ProductsController::class, 'index'])->name('products.index');

    Route::get('/products', [ProductsController::class, 'getAll']);

    Route::post('api/product', [ProductsController::class, 'store']);
    Route::put('api/product/{id}', [ProductsController::class, 'update']);
    Route::delete('api/product/{id}', [ProductsController::class, 'destroy']);

});
