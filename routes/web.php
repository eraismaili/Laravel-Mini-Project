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


Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/profile/update-password', function () {
    return view('updatepassword');
})->name('profile.update.password');

Route::put('/profile/updatePassword', [ProfileController::class, 'updatePassword'])->name('update.password');

Route::get('/employees', [EmployeesController::class, 'index'])->name('employees.index');


Route::get('/companies', [CompaniesController::class, 'index'])->name('companies.index');
Route::get('/test', [CompaniesController::class, 'store'])->name('companies.store');
Route::get('/companies/{company}', [CompaniesController::class, 'show'])->name('companies.show');
Route::put('/companies/{company}', [CompaniesController::class, 'update'])->name('companies.update');
Route::delete('/companies/{company}', [CompaniesController::class, 'destroy'])->name('companies.destroy');