<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PayPalController;


Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('paypal/pay', function () {
    return view('paypal');
})->name('paypal.pay');
Route::any('employees/export', [EmployeesController::class, 'export'])->name('employees.export');
Route::any('companies/export', [CompaniesController::class, 'export'])->name('companies.export');
Route::any('companies/import', [CompaniesController::class, 'import'])->name('companies.import');


Route::get('paypal', [PayPalController::class, 'payWithPayPal'])->name('paypal.payWithPayPal');
Route::get('paypal/status', [PayPalController::class, 'payPalStatus'])->name('paypal.status');


Route::get('/register', [AuthController::class, 'registrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

// Group routes with the same middleware
Route::middleware(['auth:web'])->group(function () {
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/update-password', [ProfileController::class, 'showUpdatePasswordForm'])->name('profile.update-password.form');
    Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Web page routes for Companies
// Route::group(['middleware' => ['role:admin']], function () {
    Route::prefix('companies')->group(function () {
        Route::get('/', [CompaniesController::class, 'index'])->name('companies.index');
        Route::get('/create', [CompaniesController::class, 'create'])->name('companies.create');
        Route::post('/', [CompaniesController::class, 'store'])->name('companies.store');
        Route::get('/{company}', [CompaniesController::class, 'show'])->name('companies.show');
        Route::get('/{company}/edit', [CompaniesController::class, 'edit'])->name('companies.edit');
        Route::put('/{company}', [CompaniesController::class, 'update'])->name('companies.update');
        Route::delete('/{company}', [CompaniesController::class, 'destroy'])->name('companies.destroy');
    });

    // Group routes with a prefix
    Route::prefix('employees')->group(function () {
        Route::get('/', [EmployeesController::class, 'index'])->name('employees.index');
        Route::get('/create', [EmployeesController::class, 'create'])->name('employees.create');
        Route::post('/', [EmployeesController::class, 'store'])->name('employees.store');
        Route::get('/{employee}', [EmployeesController::class, 'show'])->name('employees.show');
        Route::get('/{employee}/edit', [EmployeesController::class, 'edit'])->name('employees.edit');
        Route::put('/{employee}', [EmployeesController::class, 'update'])->name('employees.update');
        Route::delete('/{employee}', [EmployeesController::class, 'destroy'])->name('employees.destroy');
        Route::get('employees/data', [EmployeesController::class, 'getEmployees'])->name('employees.data');

        Route::get('employees/data', [EmployeesController::class, 'getEmployees'])->name('employees.data');
    });

});


//middlewares

//Route::middleware([CheckIfAuth::class, ':admin'])->group(function () {
//  Route::get('/users', [AuthController::class, 'index']);
//   Route::post('/users', [AuthController::class, 'store']);

//   Route::get('/companies', [CompaniesController::class, 'index']);
//   Route::post('/companies', [CompaniesController::class, 'store']);
//});
Route::get('locale/{lang}', [LocaleController::class, 'setLocale'])->name('language.change.post');
