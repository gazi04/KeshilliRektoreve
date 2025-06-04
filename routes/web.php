<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\DocumentController;
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

Route::middleware(IsLogged::class)->group(function () {
    Route::prefix('/admin')->controller(AdminController::class)->name('admin.')->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');

        Route::get('/edit', 'edit')->name('edit');
        Route::patch('/update', 'update')->name('update');

        Route::patch('/activate', 'activate')->name('activate');
        Route::patch('/deactivate', 'deactivate')->name('deactivate');
    });

    Route::prefix('/conference')->controller(ConferenceController::class)->name('conference.')->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');

        Route::get('/edit', 'edit')->name('edit');
        Route::patch('/udpate', 'update')->name('update');

        Route::patch('/toggle-status', 'toggleStatus')->name('toggleStatus');
    });

    Route::prefix('/documents')->controller(DocumentController::class)->name('document.')->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');

        Route::get('/edit', 'edit')->name('edit');
        Route::patch('/udpate', 'update')->name('update');

        Route::delete('/delete', 'destroy')->name('destroy');

        Route::post('/download', 'download')->name('download');
    });
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