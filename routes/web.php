<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/catalog', function () {
    return view('catalog');
})->name('catalog');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::view('/contact', 'contact')->name('contact');