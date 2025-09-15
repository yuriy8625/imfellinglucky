<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PageAController;
use App\Http\Middleware\VerifyUserTokenMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('welcome');

Route::post('registration', [AuthController::class, 'registration'])
    ->name('registration');

Route::middleware(VerifyUserTokenMiddleware::class)->group(function () {

    Route::post('refresh-token/{user:token}', [AuthController::class, 'refreshToken'])
        ->name('refresh-token');

    Route::post('deactivate-token/{user:token}', [AuthController::class, 'deactivateToken'])
        ->name('deactivate-token');

    Route::prefix('page-a/{user:token}')
        ->as('page-a.')
        ->group(function () {
            Route::get('', [PageAController::class, 'index'])
                ->name('index');

            Route::post('lucky', [PageAController::class, 'lucky'])
                ->name('lucky');

            Route::get('history', [PageAController::class, 'history'])
                ->name('history');
        });
});

