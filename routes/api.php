<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiCompaniesController;

// API routes
Route::prefix('api')->group(function () {
    Route::get('/companies', [ApiCompaniesController::class, 'index'])->name('companies.index');
    Route::post('/companies', [ApiCompaniesController::class, 'store'])->name('companies.store');
    Route::get('/companies/{company}', [ApiCompaniesController::class, 'show'])->name('companies.show');
    Route::put('/companies/{company}', [ApiCompaniesController::class, 'update'])->name('companies.update');
    Route::delete('/companies/{company}', [ApiCompaniesController::class, 'destroy'])->name('companies.destroy');
});
