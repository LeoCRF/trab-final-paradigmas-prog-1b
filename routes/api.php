<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::get('/users/{id}', [UserController::class, 'show']);
*/

Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::middleware(['user.type:manager,admin'])->group(function () {
        Route::apiResource('/users', UserController::class);
        Route::apiResource('/companies', CompanyController::class);
    });

    Route::middleware(['user.type:user'])->group(function() {
        Route::apiResource('/users', UserController::class)->only('show', 'update');
    });

    Route::middleware(['auth', 'check.license'])->group(function () {
        return response()->json(['message' => 'Acesso concedido a recursos protegidos.']);
    });

    Route::middleware(['check.permission:view-reports'])->group(function () {
        return response()->json(['message' => 'Acesso concedido a relatórios.']);
    });

    Route::middleware(['check.permission:edit-users,manage-users'])->group(function () {
        return response()->json(['message' => 'Acesso concedido à edição de usuários.']);
    });
});
