<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

@include_once('admin_web.php');

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
})->name('/');

Route::view('sample-page', 'admin.pages.sample-page')->name('sample-page');

Route::prefix('dashboard')->group(function () {
    
    Route::get('/',  [App\Http\Controllers\admin\UserController::class, 'allUser'])->name('allUser');
    Route::get('/createUser/{id?}',  [App\Http\Controllers\admin\UserController::class, 'create'])->name('createUser');
    Route::post('/saveUser',  [App\Http\Controllers\admin\UserController::class, 'saveUser'])->name('saveUser');
    Route::view('default', 'admin.dashboard.default')->name('dashboard.index');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
