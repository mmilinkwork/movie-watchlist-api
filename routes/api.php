<?php

use App\Http\Controllers\AddToWatchlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/add-movie-to-watchlist', [AddToWatchlistController::class, 'index']);
