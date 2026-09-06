<?php

use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/quote', [QuoteController::class, 'show']);
Route::get('/availability', [QuoteController::class, 'availability']);
Route::post('/reservations', [ReservationController::class, 'store']);
