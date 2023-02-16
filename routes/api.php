<?php

use App\Http\Controllers\Api\DeviceController;
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
Route::group(['prefix' => 'device', 'namespace' => 'Device'], function () {
    Route::post('init', [DeviceController::class, 'deviceInit']);
    Route::post('log', [DeviceController::class, 'deviceLogs']);
    Route::post('create', [DeviceController::class, 'createDevice']);
});
