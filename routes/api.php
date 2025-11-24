<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('throttle:30,1')->group(function () {
    Route::middleware('api.token')->group(function () {
        Route::get('/metrics', function (Request $request) {
            return Cache::remember('api_metrics', 60, function () {
                return [
                    'status' => 'ok',
                    'timestamp' => now()->toDateTimeString(),
                ];
            });
        });
    });
});
