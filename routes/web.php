<?php

use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

use App\Http\Controllers\HotelController;

Route::get('/', [HotelController::class, 'index']);
Route::get('/add-hotel', [HotelController::class, 'create']);
Route::post('/hoteles', [HotelController::class, 'store']);
