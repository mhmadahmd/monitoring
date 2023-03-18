<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;


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

Route::prefix('dashboard')->middleware('auth')->group(function(){
 
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::resource('products', ProductController::class);
        Route::get('/changeStatus/{id}/{status}',  [UserController::class, 'changeStatus']);
        Route::get('/activeLog',  [UserController::class, 'activeLog']);

    Route::get('/',  [App\Http\Controllers\admin\UserController::class, 'index'])->name('allUser');
    Route::get('/editUser/{id}',  [App\Http\Controllers\admin\UserController::class, 'edit'])->name('editUser');
    Route::post('/saveUser',  [App\Http\Controllers\admin\UserController::class, 'saveUser'])->name('saveUser');
    Route::post('/updateUser/{id}',  [App\Http\Controllers\admin\UserController::class, 'update'])->name('updateUser');
    Route::view('default', 'admin.dashboard.default')->name('dashboard.index');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
