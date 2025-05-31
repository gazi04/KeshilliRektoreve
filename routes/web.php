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
    Route::post('/authenticate', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware(IsLogged::class)->name('admin.')->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('index');
});

Route::prefix('members')->name('members.')->group(function () {
    Route::get('/', [MembersController::class, 'index'])->name('index');
    Route::get('/create', [MembersController::class, 'create'])->name('create');
    Route::post('/', [MembersController::class, 'store'])->name('store');
    Route::get('/{member}', [MembersController::class, 'show'])->name('show');
    Route::get('/{member}/edit', [MembersController::class, 'edit'])->name('edit');
    Route::put('/{member}', [MembersController::class, 'update'])->name('update');
    Route::delete('/{member}', [MembersController::class, 'destroy'])->name('destroy');
});