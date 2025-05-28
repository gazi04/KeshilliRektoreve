<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\IsLogged;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginPage')->name('loginPage');
    Route::post('/authenticate', 'login')->name('authenticate');
});

Route::middleware(IsLogged::class)->name('admin.')->group(function() {
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('index');
});
