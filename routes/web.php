<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\CompaniesController;
use App\Http\Middleware\CheckIfAuth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', [AuthController::class, 'RegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'LoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'LoginForm'])->name('login');

Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');



Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/profile/update-password', [ProfileController::class, 'showUpdatePasswordForm'])->name('profile.update-password.form');
Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

Route::get('/employees', [EmployeesController::class, 'index'])->name('employees.index');
Route::resource('employees', EmployeesController::class);

// Web page routes
Route::resource('companies', CompaniesController::class);


//Route::middleware([CheckIfAuth::class . ':admin'])->group(function () {
//});
//Route::middleware([CheckIfAuth::class . ':user'])->group(function () {
//});