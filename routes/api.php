<?php

use App\Http\Controllers\AddToWatchlistController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

Route::post('/user/generate-token', [TokenController::class, 'store']);

Route::post('/add-movie-to-watchlist', [AddToWatchlistController::class, 'index'])->middleware('auth:sanctum');
