<?php

use App\Http\Controllers\mainController;
use App\Http\Controllers\authController;
use Illuminate\Support\Facades\Route;


Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register-proses', [AuthController::class, 'registerProses'])->name('register.proses')->middleware('guest');

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authProcess'])->middleware(['guest']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function(){

    Route::get('/', [mainController::class, 'index']);
    Route::get('/rank', [mainController::class, 'rank'])->name('rank');
    Route::get('/history', [mainController::class, 'history'])->name('history');
    Route::post('/relapsed', [mainController::class, 'relapsed'])->name('relapsed');



});

