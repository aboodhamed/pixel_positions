<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\searchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobController::class, 'index']);

Route::middleware('guest')->group(function () {
    
    Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'store']);
    
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
       
});

Route::middleware('auth')->group(function () {
    Route::get('/jobs',[JobController::class, 'create']);
    Route::post('/jobs',[JobController::class, 'store']);
    Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');

});

Route::get('/search',searchController::class);
Route::get('/tags/{tag:name}',TagController::class);

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');
