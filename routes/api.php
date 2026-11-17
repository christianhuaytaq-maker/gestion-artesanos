<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArtesanoApiController; 

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 👈 Agregamos ->names('api.artesanos') al final
Route::apiResource('artesanos', ArtesanoApiController::class)->names('api.artesanos');