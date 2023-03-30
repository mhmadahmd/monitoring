<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ApplicationController;
use App\Http\Controllers\LangController;


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

Route::prefix('dashboard','{locale}')->middleware('auth','setapplang')->group(function(){

    Route::get('/', function () {
        return redirect()->route('allUser');
    })->name('/');

    Route::get('lang/home', [LangController::class, 'index']);
    Route::get('changeLang/{lang}', [LangController::class, 'change'])->name('changeLang');
 
        Route::resource('roles', RoleController::class);
        // Route::resource('users', UserController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('app',ApplicationController::class);
        Route::resource('products', ProductController::class);
        Route::get('/changeStatus/{id}/{status}',  [UserController::class, 'changeStatus']);
        Route::get('/activeLog',  [UserController::class, 'activeLog'])->name('activeLog');

    // Route::get('/',  [UserController::class, 'index'])->name('allUser');
    // Route::get('/editUser/{id}',  [UserController::class, 'edit'])->name('editUser');
    // Route::post('/saveUser',  [UserController::class, 'saveUser'])->name('saveUser');
    // Route::post('/updateUser/{id}',  [UserController::class, 'update'])->name('updateUser');
    Route::post('/categoryUpdate/{id}',  [CategoryController::class, 'update'])->name('categoryUpdate');
    Route::post('/appUpdate/{id}',  [ApplicationController::class, 'update'])->name('appUpdate');
    Route::view('default', 'admin.dashboard.default')->name('dashboard.index');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
