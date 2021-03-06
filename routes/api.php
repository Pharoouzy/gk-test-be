<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\LocationController;

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

Route::group(['namespace' => 'V1', 'prefix' => 'v1'], function () {
    Route::group(['namespace' => 'V1', 'prefix' => 'locations'], function () {
        Route::get('search', [LocationController::class, 'searchLocation']);
        Route::get('', [LocationController::class, 'index']);
        Route::post('', [LocationController::class, 'store']);
    });
});
