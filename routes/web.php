<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpanceController;
use App\Http\Controllers\MonthlyLimitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;




// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard',[DashboardController::class, 'dashboard'])
        ->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/ajax/chart/monthly_expenses', [DashboardController::class, 'ajaxMonthlyExpenseChart'])
    ->name('ajax.chart.monthly_expenses');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::controller(ExpanceController::class)->group(function () {
        Route::get('/expenses', 'index')->name('expenses.index');
        Route::post('/expenses/filter', 'IndexFilter')->name('expenses.index.filter');
        Route::get('/expenses/create', 'create')->name('expenses.create');
        Route::post('/expenses/store', 'store')->name('expenses.store');
        Route::get('/expenses/edit/{expance}', 'edit')->name('expenses.edit');
        Route::put('/expenses/update/{expance}', 'update')->name('expenses.update');
        Route::delete('/expenses/delete/{expance}', 'destroy')->name('expenses.destroy');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'Index')->name('categories.index');
        Route::get('/categories/create', 'Create')->name('categories.create');
        Route::post('/categories/store', 'Store')->name('categories.store');
        Route::get('/categories/edit/{category}', 'Edit')->name('categories.edit');
        Route::put('/categories/update/{category}', 'Update')->name('categories.update');
        Route::delete('/categories/delete/{category}', 'Destroy')->name('categories.destroy');
    });

    Route::controller(MonthlyLimitController::class)->group(function () {
        Route::post('/monthly-limit/store', 'store')->name('monthly_limit.store');
        Route::put('/monthly-limit/update', 'update')->name('monthly_limit.update');
    });

    Route::controller(ReportsController::class)->group(function () {
        Route::get('/reports', 'index')->name('reports.index');
        Route::post('/reports/monthly_report', 'monthlyReport')->name('reports.monthly_report');
        Route::get('/reports/download_pdf/{month}', 'downloadPDF')->name('reports.download_pdf');
    });
});

require __DIR__.'/auth.php';
