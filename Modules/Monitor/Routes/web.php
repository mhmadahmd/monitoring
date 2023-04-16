<?php

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

Route::prefix('monitor')->group(function() {
    Route::get('/', 'MonitorController@index');
    Route::get('/Mintenance', 'MintenanceController@Mintenancedown')->middleware('CheckURL');
    Route::get('/Mintenanceup', 'MintenanceController@MintenanceUP')->middleware('CheckURL');
    Route::get('/UserOnline', 'MintenanceController@countUserOnline');
});
