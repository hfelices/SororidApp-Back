<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\RoutePartnerController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarningController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('locations', LocationController::class);
Route::apiResource('regions', RegionController::class);
Route::apiResource('relations', RelationController::class);
Route::apiResource('routes', RouteController::class);
Route::apiResource('routepartners', RoutePartnerController::class);
Route::apiResource('towns', TownController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('warnings', WarningController::class);

// Route::middleware('auth:sanctum')->apiResource('locations', LocationController::class);
// Route::middleware('auth:sanctum')->apiResource('regions', RegionController::class);
// Route::middleware('auth:sanctum')->apiResource('relations', RelationController::class);
// Route::middleware('auth:sanctum')->apiResource('routes', RouteController::class);
// Route::middleware('auth:sanctum')->apiResource('routepartners', RoutePartnerController::class);
// Route::middleware('auth:sanctum')->apiResource('towns', TownController::class);
// Route::middleware('auth:sanctum')->apiResource('users', UserController::class);
// Route::middleware('auth:sanctum')->apiResource('warnings', WarningController::class);