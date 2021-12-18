<?php

use Illuminate\Support\Facades\Route;

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
});
//Route::get('users/loginpage',[\App\Http\Controllers\LoginController::class,'showLoginPage'])->name('login');
//Route::get('users/registerpage',[\App\Http\Controllers\RegisterController::class,'showRegisterPage']);
//Route::post('users/login',[\App\Http\Controllers\LoginController::class,'authenticate'])->name('auth.Login');
//Route::post('users/register',[\App\Http\Controllers\RegisterController::class,'registerUser'])->name('auth.Register');

Route::get('salam/test',[\App\Http\Controllers\ScheduleController::class,'index']);
Route::get('collect',[\App\Http\Controllers\guzzelController::class,'test']);
