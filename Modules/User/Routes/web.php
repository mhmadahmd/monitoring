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

// Route::prefix('user')->group(function() {
    // Route::get('/', 'UserController@index');
    Route::resource('users','UserController');

    Route::get('/',  'UserController@index')->name('allUser');
    Route::get('/editUser/{id}',  'UserController@edit')->name('editUser');
    Route::post('/saveUser',  'UserController@store')->name('saveUser');
    Route::post('/updateUser/{id}', 'UserController@update')->name('updateUser');
// });
