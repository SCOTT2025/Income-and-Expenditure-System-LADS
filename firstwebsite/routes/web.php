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

    // Role management
    Route::resource('roles', RoleController::class);
    Route::post('roles/bulk-delete', [RoleController::class, 'bulkDelete'])->name('roles.bulkDelete');

    // User management
    Route::resource('users', UserController::class);
    Route::post('users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulkDelete');

    // Permission management
    Route::resource('permissions', PermissionController::class);
    Route::post('permissions/bulk-delete', [PermissionController::class, 'bulkDelete'])->name('permissions.bulkDelete');

    // Expense Category
    Route::resource('expense-categories', ExpenseCategoryController::class);
    Route::post('expense-categories/bulk-delete', [ExpenseCategoryController::class, 'bulkDelete'])->name('expense-categories.bulkDelete');

    // Income Category
    Route::resource('income_categories', IncomeCategoryController::class);
    Route::post('income_categories/bulk-delete', [IncomeCategoryController::class, 'bulkDelete'])->name('income_categories.bulkDelete');

    // ✅ Expense entries (updated)
    Route::resource('expenses', ExpenseController::class);
    Route::post('expenses/bulk-delete', [ExpenseController::class, 'bulkDelete'])->name('expenses.bulkDelete');

    // Income entries
    Route::resource('incomes', IncomeController::class);
    Route::post('incomes/bulk-delete', [IncomeController::class, 'bulkDelete'])->name('incomes.bulkDelete');

    // Reports
    Route::get('/monthly-report', [ReportController::class, 'monthly'])->name('reports.monthly');
});

// Auth scaffolding (Laravel Breeze)
require __DIR__.'/auth.php';
