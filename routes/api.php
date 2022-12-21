<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::get('getallproduct', [ProductController::class, 'getAllProducts']);
Route::post('viewsingleproduct', [ProductController::class, 'viewSingleProduct']);
Route::post('addproduct', [ProductController::class, 'addProduct']);
Route::post('updateproduct', [ProductController::class, 'updateProduct']);
Route::post('deleteproduct', [ProductController::class, 'deleteProduct']);
Route::post('searchproduct', [ProductController::class, 'searchProduct']);

