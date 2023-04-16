<?php

use Illuminate\Http\Request;
use Modules\Monitor\Http\Controllers\MonitorController;


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

Route::middleware('auth:sanctum')->get('/monitor', function (Request $request) {

    return $request->user();
}); 

Route::prefix('monitor')->group(function() {
    Route::get('/getCheck/{id}', 'MintenanceController@getCheck');
    Route::get('/UserOnline', 'MintenanceController@countUserOnline');
    Route::get('/CheckRun', 'MintenanceController@CheckRun');
});

