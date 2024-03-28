<?php

use App\Http\Controllers\DashboarController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

Route::controller(DashboarController::class)->group(function () {

    Route::GET   ('/dashboard','index')->name('dashboard');
        // user dashboard
    Route::GET   ('/dashboard/user','user')->name('dashboard.user');
    Route::DELETE  ('/dashboard/user/{id}','deleteUser')->name('dashboard.user.delete');
    Route::POST  ('/dashboard/user/add','addUser')->name('dashboard.user.add');
    Route::POST  ('/dashboard/user/update/{id}','updateUser')->name('dashboard.user.update');

    // Stock Dashboard
    Route::GET   ('/dashboard/stock', 'viewStock')->name('dashboard.stock');
    Route::POST  ('/dashboard/stock/add','createStock')->name('dashboard.stock.add');
});

