<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('users/count', [UserController::class, 'count']);
    Route::apiResource('users', UserController::class);
    Route::apiResource('perfis', PerfilController::class)->parameter('perfis', 'perfil');
});