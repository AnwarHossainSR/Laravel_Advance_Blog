<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

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

//Authentication to redirect dashboard
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/superadmin',[LoginController::class,'superAdminDashboard'])->name('superadmin.dashboard');
        Route::get('/admin',[LoginController::class,'adminDashboard']);
        Route::get('/author',[LoginController::class,'authorDashboard']);
        Route::get('/user',[LoginController::class,'userDashboard']);
    });
});
