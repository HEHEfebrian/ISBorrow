<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/catalog', function () {
    return view('catalog');
})->name('catalog');

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::post('/admin/borrow-requests/{borrowRequest}/accept', [AdminController::class, 'acceptRequest'])
        ->name('admin.borrow_requests.accept');

    Route::post('/admin/borrow-requests/{borrowRequest}/reject', [AdminController::class, 'rejectRequest'])
        ->name('admin.borrow_requests.reject');
});

Route::view('/contact', 'contact')->name('contact');
