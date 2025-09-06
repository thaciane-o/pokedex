<?php

use App\Http\Controllers\auth\UserAuth;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Route::redirect('/', '/login');
    Route::view('/login', 'login')->name('login');
    Route::view('/register', 'register')->name('register');

    Route::post('login', [UserAuth::class, 'login'])->name('login');
    Route::post('register', [UserAuth::class, 'register'])->name('register');
});

