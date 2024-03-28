<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get  ("/",  [UserController::class, "login"]);
Route::get  ("/signup",  [UserController::class, "register"])->name('auth.register');
Route::get  ("/logout",  [UserController::class, "logout"])->name('auth.logout');

Route::post ("/auth",    [UserController::class, "auth"])->name('auth.auth');
Route::post ("/addUser", [UserController::class, "create"])->name('auth.createUser');
