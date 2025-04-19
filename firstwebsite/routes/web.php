<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ReportController;

// Redirect to login or dashboard depending on auth status
Route::get('/', function () {
    return Auth::check() ? redirect('/dashboard') : redirect('/login');
});

// Everything below requires user to be authenticated
Route::middleware(['auth'])->group(function () {

    // Dashboard view
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Logout Route
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');

    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Role management (no "admin" prefix, clean URLs like /roles)
    Route::resource('roles', RoleController::class);
    Route::delete('roles/mass-destroy', [RoleController::class, 'massDestroy'])->name('roles.massDestroy');

    //  User management
    Route::resource('users', UserController::class);

    // Permission management
    Route::resource('permissions', PermissionController::class);
    Route::post('permissions/bulk-delete', [PermissionController::class, 'bulkDelete'])->name('permissions.bulkDelete');

    // Expense/Income categories
    Route::resource('expense_categories', ExpenseCategoryController::class);
    Route::resource('income_categories', IncomeCategoryController::class);

    // Expense/Income entries
    Route::resource('expenses', ExpenseController::class);
    Route::resource('income', IncomeController::class);

    // Reports
    Route::get('/monthly-report', [ReportController::class, 'monthly'])->name('reports.monthly');
});

// Auth scaffolding (Breeze/Fortify)
require __DIR__.'/auth.php';
