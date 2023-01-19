<?php


use App\Http\Controllers\Api\TourController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserStationController;
use App\Http\Controllers\Api\StationController;
use App\Http\Controllers\Api\FriendController;
use App\Http\Controllers\Api\TourStationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware('auth:sanctum')->get('/auth', function () {
//    return true;
//});

Route::middleware('auth:sanctum')->post('logout', [AuthenticatedSessionController::class, 'destroy']);


Route::post('register', [RegisteredUserController::class, 'store']);
Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::apiResource('friends', FriendController::class);
Route::get('tours/statistics', [TourController::class, 'statistics']);
Route::get('tours/friends', [TourController::class, 'friendsTours']);
Route::get('profile/friends/{id}', [FriendController::class, 'friendsByUserId']);
Route::delete('profile/friends/{id}', [FriendController::class, 'deleteFriend']);
Route::post('profile/friends', [FriendController::class, 'addFriendToCurrentUser']);
Route::get('profile/active', [UserController::class, 'activeUser']);
Route::post('tours/admin', [TourController::class, 'storeAdmin']);

Route::apiResource('tours', TourController::class);
Route::apiResource('user_stations', UserStationController::class);
Route::apiResource('stations', StationController::class);
Route::apiResource('profile', UserController::class);
Route::apiResource('tour_station', TourStationController::class);

