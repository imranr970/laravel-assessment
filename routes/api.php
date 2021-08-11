<?php

use App\Http\Controllers\accountConfirmationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\userInviteController;

Route::post('/login', [loginController::class, 'login']);

Route::post('/me', [profileController::class, 'me']);

Route::post('/register', [registerController::class, 'register']);

Route::post('/profile', [profileController::class, 'index']);

Route::post('profile/update', [profileController::class, 'update']);

Route::post('invite', [userInviteController::class, 'invite']);

Route::get('confirm-account', [accountConfirmationController::class, 'confirm']);