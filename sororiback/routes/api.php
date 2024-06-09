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
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::middleware('auth:sanctum')->apiResource('locations', LocationController::class);
Route::middleware('auth:sanctum')->apiResource('regions', RegionController::class);
Route::middleware('auth:sanctum')->apiResource('relations', RelationController::class);
Route::middleware('auth:sanctum')->apiResource('routes', RouteController::class);
Route::middleware('auth:sanctum')->apiResource('routepartners', RoutePartnerController::class);
Route::middleware('auth:sanctum')->apiResource('towns', TownController::class);
Route::middleware('auth:sanctum')->apiResource('users', UserController::class);
Route::middleware('auth:sanctum')->apiResource('profiles', ProfileController::class);
Route::middleware('auth:sanctum')->apiResource('warnings', WarningController::class);

Route::middleware('auth:sanctum')->get('/relations/{user}/explore', [RelationController::class, 'explore'])->name('relations.explore');
Route::middleware('auth:sanctum')->get('/relations/{user}/pending', [RelationController::class, 'pending'])->name('relations.pending');
Route::middleware('auth:sanctum')->get('/relations/{user}/{type}', [RelationController::class, 'get_user_relations'])->name('relations.type');
Route::middleware('auth:sanctum')->post('/profiles/{id}/image', [ProfileController::class, 'updateProfileImage'])->name('profiles.image');
Route::middleware('auth:sanctum')->post('/routes/{id}/verifyPassword', [RouteController::class, 'verifyPassword'])->name('routes.verifyPassword');
Route::middleware('auth:sanctum')->get('/routes/{user}/explore', [RouteController::class, 'explore'])->name('routes.explore');
