<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix("/category-products")
    ->controller(\App\Http\Controllers\CategoryProductController::class)
    ->group(function () {
        Route::post("", "create");
        Route::get("", "getAll");
        Route::get("/{id}", "getById");
        Route::put("/{id}", "update");
        Route::delete("/{id}", "delete");
    });

Route::prefix("/products")
    ->controller(\App\Http\Controllers\ProductController::class)
    ->group(function () {
        Route::post("", "create");
        Route::get("", "getAll");
        Route::get("/{id}", "getById");
        Route::put("/{id}", "update");
        Route::delete("/{id}", "delete");
    });
