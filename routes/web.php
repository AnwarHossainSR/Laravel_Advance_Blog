<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('auth/login', [LoginController::class,'login'])->name('login.custom');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/superadmin',[LoginController::class,'superAdminDashboard'])->name('superadmin.dashboard');
        Route::get('/admin',[LoginController::class,'adminDashboard'])->name('admin.dashboard');
        Route::get('/author',[LoginController::class,'authorDashboard'])->name('author.dashboard');
        Route::get('/user',[LoginController::class,'userDashboard'])->name('user.dashboard');
    });
});

Route::get('/user-home', [UserController::class, 'index'])->name('user.home');
