<?php

use App\Http\Controllers\auth\UserAuth;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::redirect('/', '/login');
    Route::view('/login', 'login')->name('login');
    Route::view('/register', 'register')->name('register');

    Route::post('/login', [UserAuth::class, 'login'])->name('login');
    Route::post('/register', [UserAuth::class, 'register'])->name('register');

});
// web.php
Route::post('/upload', [UploadController::class, 'store'])->name('upload');
Route::post('/upload/remove', [UploadController::class, 'remove'])->name('upload.remove');

Route::middleware(['auth', 'verified'])->group(function () {

    //Dashboard
    Route::redirect('/', 'dashboard/home');
    Route::get('dashboard/home', [DashboardController::class, 'home'])->name('dashboard.home');
    Route::get('log', [DashboardController::class, 'log'])->name('dashboard.log');

    // Funcionario
    Route::get('funcionario/dados', [FuncionarioController::class, 'dados'])->name('funcionario.dados');
    Route::post('/upload/avatar', [FuncionarioController::class, 'fileStore'])->name('upload.avatar');
    Route::post('/upload/avatar/delete', [FuncionarioController::class, 'fileDestroy'])->name('upload.avatar.delete');
    Route::resource('funcionario', FuncionarioController::class);

    //Chat
    Route::resource('chat', ChatController::class);

    // Pokemon
    Route::resource('pokemon', PokemonController::class);

    Route::get('/logout', [UserAuth::class, 'logout'])->name('logout');

});

Route::fallback(function () {
    return redirect('/');
});
