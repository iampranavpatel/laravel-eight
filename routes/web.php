<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [HomeController::class,'index']);

Route::get('product', [ProductController::class,'index'])
->name('product.index');
Route::get('product/add', [ProductController::class,'add'])
->name('product.add');
Route::post('product/store', [ProductController::class,'store'])
->name('product.store');
Route::get('product/show/{id}',[ProductController::class,'show'])
->name('product.show');
Route::get('product/edit/{id}',[ProductController::class,'edit'])
->name('product.edit');
Route::post('product/update/{id}', [ProductController::class, 'update'])
->name('product.update');
Route::post('product/delete/{id}',[ProductController::class,'delete'])
->name('product.delete');
Route::any('product/search',[ProductController::class,'search'])
->name('product.search');

/* Route::resource('product', ProductController::class); */