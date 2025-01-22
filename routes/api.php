<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group( function() {
    Route::get('articles', [\App\Http\Controllers\Api\ArticleController::class, 'index'] )->name('articles.index');
    Route::get('articles/{slug}', [\App\Http\Controllers\Api\ArticleController::class, 'show'] )->name('articles.show');

    Route::get('authors', [\App\Http\Controllers\Api\AuthorController::class, 'index'] )->name('authors.index');
    Route::get('authors/{id}', [\App\Http\Controllers\Api\AuthorController::class, 'show'] )->name('authors.show');

});

