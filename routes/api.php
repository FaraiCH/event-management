<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

Route::apiResource('events', \App\Http\Controllers\EventController::class);
Route::apiResource('events.attendees', \App\Http\Controllers\AttendeeController::class)->scoped()->except(['update']);
