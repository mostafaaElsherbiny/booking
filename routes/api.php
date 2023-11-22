<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('cities', 'App\Http\Controllers\Api\CityController@index');

Route::get('trips', 'App\Http\Controllers\Api\TripController@index');

Route::post('bookings', 'App\Http\Controllers\Api\BookingController@store');
