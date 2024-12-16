<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Middleware\PreventSelfDestroyMiddleware;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('perfis', PerfilController::class)->parameter('perfis', 'perfil');
    
    Route::get('users/count', [UserController::class, 'count']);
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::middleware(CheckAdminMiddleware::class)->group(function () {
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware(PreventSelfDestroyMiddleware::class)->name('users.destroy');
    });
});