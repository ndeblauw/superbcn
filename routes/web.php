<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public visible routes
Route::get('/', \App\Http\Controllers\WelcomeController::class)->name('welcome');

Route::get('articles', [\App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/{id}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');

// Authenticated routes
require __DIR__.'/auth.php';
Route::name('user.')->middleware(['auth', 'verified'])->group(function () {
    Route::resource('user/articles', App\Http\Controllers\User\ArticleController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
