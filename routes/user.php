<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware(['isGuest'])->group(function () {
    Route::get("/", [UserController::class, "login"]);
    Route::post("/auth", [UserController::class, "auth"])->name('auth.auth');
});
Route::get("/logout", [UserController::class, "logout"])->name('auth.logout');
