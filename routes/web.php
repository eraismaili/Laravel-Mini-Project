<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\CompaniesController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [AuthController::class, 'RegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'LoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


Route::get('/profile', [ProfileController::class, 'show']);
Route::post('/profile', [ProfileController::class, 'updatePassword'])->name('update.password');

Route::get('/employees', [EmployeesController::class, 'index'])->name('employees.index');
Route::get('/companies', [CompaniesController::class, 'index'])->name('companies.index');

