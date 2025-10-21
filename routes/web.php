<?php

    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\backend\AttendenceController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\DepartmentController;
use App\Http\Controllers\backend\EmployeeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/','index')->name('dashboard');
    });

    Route::resource('/department', DepartmentController::class);

    Route::get('/employee/get_employee', [EmployeeController::class, 'get_employee'])->name('employee.get_employee');
    Route::get('/employee/get_employee_json', [EmployeeController::class, 'get_employee_json'])->name('employee.get_employee_json');
    Route::get('/employees/get-positions-by-department/{department_id}', [EmployeeController::class, 'getPositionsByDepartment'])->name('employees.getPositionsByDepartment');
    Route::resource('/employee', EmployeeController::class);

    Route::controller(AttendenceController::class)->group(function(){
        Route::get('/attendences','index')->name('attendences.index');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Routes that do not require authentication
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

// Fallback Route
Route::fallback(function(){
    return view('error.404');
});

