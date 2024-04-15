<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::middleware(['isLogin'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        // user dashboard
        Route::get('/dashboard/user', 'user')->name('dashboard.user');
        Route::get('/dashboard/user/register', 'register')->name('dashboard.get.auth');
        Route::delete('/dashboard/user/{id}', 'deleteUser')->name('dashboard.user.delete');
        Route::post('/dashboard/user/add', 'addUser')->name('dashboard.user.add');
        Route::post('/dashboard/user/update/{id}', 'updateUser')->name('dashboard.user.update');

        // Stock Dashboard
        Route::get('/dashboard/stock', 'viewStock')->name('dashboard.stock');
        Route::get('/dashboard/stock/history', 'getHistoryStock')->name('dashboard.stock.history');
        Route::post('/dashboard/stock/add', 'createStock')->name('dashboard.stock.add');
        Route::post('/dashboard/stock/update/{id}', 'updateStock')->name('dashboard.stock.updateStock');
        Route::post('/dashboard/stock/edit/{id}', 'editStock')->name('dashboard.stock.editStock');
        
    });

    Route::get('/dashboard/pembelian', [DashboardController::class,'getPembelian'])->name('dashboard.pembelian');
    Route::post('/dashboard/pembelian/confirmPayment', [DashboardController::class, 'confirmPayment'])->name('dashboard.confirmPayment');
    Route::get('/dashboard/pembelian/invoice', [DashboardController::class, 'pdfInvoice'])->name('dashboard.pembelian.invoice');
    Route::get('/dashboard/pembelian/direct', [DashboardController::class, 'backToPembelian'])->name('dashboard.pembelian.direct');
    
});

