<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsLogged;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginPage')->name('loginPage');
    Route::post('/authenticate', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware(IsLogged::class)->group(function () {
    Route::controller(AdminController::class)->name('admin.')->group(function () {
        Route::get('/admin-dashboard', 'index')->name('index');

        Route::get('/create-admin', 'create')->name('create');
        Route::post('/store-admin', 'store')->name('store');

        Route::get('/edit-admin', 'edit')->name('edit');
        Route::patch('/update-admin', 'update')->name('update');

        Route::patch('/activate-admin', 'activate')->name('activate');
        Route::patch('/deactivate-admin', 'deactivate')->name('deactivate');
    });
});

Route::get('/testdata', function () {
    Admin::factory()->create([
        'username' => 'gazi',
    ]);
});
