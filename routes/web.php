<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\LoginController;
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
Route::post('/user/register', [UserController::class, "store"]);
Route::post('/user/login', [LoginController::class, "login"]);
Route::post('/login', [LoginController::class, "login"])->name("login");
Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');
