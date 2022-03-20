<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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

/** URLS Products */
Route::prefix('products')->group(function(){
    Route::get('/', [ProductsController::class, 'index']);
    Route::get('/product/{id}', [ProductsController::class, 'show']);
    Route::post('/new', [ProductsController::class, 'store']);
    Route::put('/update/{id}', [ProductsController::class, 'update']);
    Route::delete('/delete/{id}', [ProductsController::class, 'destroy']);
});
