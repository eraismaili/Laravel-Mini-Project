<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\CompaniesController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', [AuthController::class, 'registrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/update-password', [ProfileController::class, 'showUpdatePasswordForm'])->name('profile.update-password.form');
Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

// Web page routes for Companies
// Route::group(['middleware' => ['role:admin']], function () {
Route::get('/companies', [CompaniesController::class, 'index'])->name('companies.index');
Route::get('/companies/create', [CompaniesController::class, 'create'])->name('companies.create');
Route::post('/companies', [CompaniesController::class, 'store'])->name('companies.store');
Route::get('/companies/{company}', [CompaniesController::class, 'show'])->name('companies.show');
Route::get('/companies/{company}/edit', [CompaniesController::class, 'edit'])->name('companies.edit');
Route::put('/companies/{company}', [CompaniesController::class, 'update'])->name('companies.update');
Route::delete('/companies/{company}', [CompaniesController::class, 'destroy'])->name('companies.destroy');
// });

//Web page routes for Employees 

Route::get('/employees', [EmployeesController::class, 'index'])->name('employees.index');
Route::get('/employees/create', [EmployeesController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeesController::class, 'store'])->name('employees.store');
Route::get('/employees/{employee}', [EmployeesController::class, 'show'])->name('employees.show');
Route::get('/employees/{employee}/edit', [EmployeesController::class, 'edit'])->name('employees.edit');
Route::put('/employees/{employee}', [EmployeesController::class, 'update'])->name('employees.update');
Route::delete('/employees/{employee}', [EmployeesController::class, 'destroy'])->name('employees.destroy');

//middlewares

//Route::middleware([CheckIfAuth::class, ':admin'])->group(function () {
//  Route::get('/users', [AuthController::class, 'index']);
//   Route::post('/users', [AuthController::class, 'store']);

//   Route::get('/companies', [CompaniesController::class, 'index']);
//   Route::post('/companies', [CompaniesController::class, 'store']);
//});

