<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    MemberController,
    CollectionController,
    ReportController,
    MemberPrintController
};

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home'); // simple homepage with Login button
})->name('home');

/*
|--------------------------------------------------------------------------
| Authenticated (Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Members
    Route::resource('members', MemberController::class);
    Route::get('/members/{member}/details', [MemberController::class, 'details'])->name('members.details');
    Route::get('/members/{member}/print', [MemberPrintController::class, 'show'])->name('members.print');

    // Collections
    Route::get('/collections/create', [CollectionController::class, 'create'])->name('collections.create');
    Route::post('/collections', [CollectionController::class, 'store'])->name('collections.store');
    Route::get('/collections/{payment}/receipt', [CollectionController::class, 'showReceipt'])->name('collections.receipt.show');
    Route::get('/collections/{payment}/receipt/download', [CollectionController::class, 'downloadReceipt'])->name('collections.receipt.download');

    // Reports
    Route::get('/reports/unpaid', [ReportController::class, 'unpaid'])->name('reports.unpaid');
    Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
});

/*
|--------------------------------------------------------------------------
| Breeze / Auth routes (login, logout, etc.)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
