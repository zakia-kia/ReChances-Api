<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

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

//user controller
Route::post('register',[UserController::class, 'registerUser']);
Route::post('login',[UserController::class, 'loginUser']);
Route::post('logout',[UserController::class, 'logoutUser']);
Route::post('user/update/{id}',[UserController::class, 'updateUser']);
Route::get('user/get/{id}',[UserController::class, 'getUser']);

//category controller
Route::get('category/get/{id}',[CategoryController::class, 'showById']);
Route::get('category/get/',[CategoryController::class, 'showAll']);

//product controller
Route::get('/product/get/{id}',[ProductController::class, 'showById']);
Route::get('/product/get/',[ProductController::class, 'showAll']);
Route::post('/product/create/', [ProductController::class,'createProduct']);
Route::post('/product/update/{post}', [ProductController::class,'updateProduct']);
Route::delete('/product/delete/{post}', [ProductController::class,'deleteProduct']);

// plus fitur
Route::get('/products',[ProductController::class, 'filter']);
Route::get("search/{name}",[ProductController::class, 'search']);
Route::get("searchLoc/{location}",[ProductController::class, 'searchLoc']);

//order controller
Route::get('/order/get/{id}',[OrderController::class, 'showById']);
Route::get('/order/get/',[OrderController::class, 'showAll']);
Route::post('/order/create/', [OrderController::class,'createOrder']);
Route::post('/order/update/{post}', [OrderController::class,'updateOrder']);
Route::delete('/order/delete/{post}', [OrderController::class,'deleteOrder']);
