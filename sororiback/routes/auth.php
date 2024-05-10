<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::post('api/register', [UserController::class, 'store'])
                ->middleware('guest')
                ->name('register');

Route::post('api/login', [AuthController::class, 'login'])
                ->middleware('guest')
                ->name('login');

Route::post('api/logout', [AuthController::class, 'logout'])
                ->middleware('auth')
                ->name('logout');


// Route::post('api/forgot-password', [PasswordResetLinkController::class, 'store'])
// ->middleware('guest')
// ->name('password.email');

// Route::post('api/reset-password', [NewPasswordController::class, 'store'])
//                 ->middleware('guest')
//                 ->name('password.store');

// Route::get('api/verify-email/{id}/{hash}', VerifyEmailController::class)
//                 ->middleware(['auth', 'signed', 'throttle:6,1'])
//                 ->name('verification.verify');

// Route::post('api/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
//                 ->middleware(['auth', 'throttle:6,1'])
//                 ->name('verification.send');