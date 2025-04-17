<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ReportController;

// Dashboard
Route::get('/', function () {
    return view('welcome');
})->name('dashboard');


// User Management
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);

// Expense & Income Categories
Route::resource('expense_categories', ExpenseCategoryController::class);
Route::resource('income_categories', IncomeCategoryController::class);

// Expenses & Income
Route::resource('expenses', ExpenseController::class);
Route::resource('income', IncomeController::class);

// Reports
Route::get('/monthly-report', [ReportController::class, 'monthly'])->name('reports.monthly');


