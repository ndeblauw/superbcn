<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public visible routes
Route::get('/', \App\Http\Controllers\WelcomeController::class)->name('welcome');

Route::get('articles', [\App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/{slug}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');
Route::get('articles/{slug}/buy/{amount}', [\App\Http\Controllers\PurchaseController::class, 'preparePayment'])->name('articles.buy');

Route::get('purchases/{purchase}/success', [\App\Http\Controllers\PurchaseController::class, 'successfulPayment'])->name('purchase.success');

Route::get('set-locale/{locale}', \App\Http\Controllers\SetLocaleController::class)->name('set-locale');

// Authenticated routes
require __DIR__.'/auth.php';
Route::name('user.')->middleware(['auth', 'verified'])->group(function () {
    Route::resource('user/articles', App\Http\Controllers\User\ArticleController::class);
    Route::get('user/articles/{id}/publish', \App\Http\Controllers\User\ArticlePublishController::class)->name('articles.publish');
});

// Todo: fix thnis in correct layout
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
