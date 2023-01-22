<?php

use App\Http\Controllers\HackerNewsItemController;
use App\Http\Controllers\LoginController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/items', [HackerNewsItemController::class, 'index']);
Route::prefix('/items')->group( function () {
        Route::post('/delete', [HackerNewsItemController::class, 'deleteAll']);
    }
);
Route::prefix('/item')->group( function () {
        Route::post('/store', [HackerNewsItemController::class, 'store']);
        Route::put('/{id}', [HackerNewsItemController::class, 'update']);
    }
);

Route::prefix('/login')->group( function () {
        Route::post('/login', [LoginController::class, 'store']);
    }
);