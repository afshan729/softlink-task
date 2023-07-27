<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeeController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function() {
    if (session()->has('admin')) {
        return view('pages.dashboard');
    } else {
        return redirect()->route('admin.login');
    }
});

Route::get('optimize-app', function() {
    Artisan::call('optimize:clear');
});


Route::group(['middleware' => ['admin.pages']], function() {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    //employees pages
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::match(['get', 'post'], 'add-employee', [EmployeeController::class, 'store'])->name('add-employee');
    Route::get('delete-employee', [EmployeeController::class, 'destroy'])->name('delete-employee');
    Route::match(['get', 'post'], 'edit-employee/{id}', [EmployeeController::class, 'update'])->name('edit-employee');
    Route::get('/employees/export', [EmployeeController::class, 'exportEmployees'])->name('employees.export');
    Route::post('/employees/import', [EmployeeController::class, 'import'])->name('employees.import');


});

Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('admin.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
