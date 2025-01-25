<?php

use Illuminate\Support\Facades\Route;

Route::post('purchases/webhooks/mollie', [\App\Http\Controllers\PurchaseController::class, 'webhook'])->name('webhooks.mollie');


Route::name('api.')->group(function () {
    Route::apiResource('articles', \App\Http\Controllers\Api\ArticleController::class);

    Route::get('authors', [\App\Http\Controllers\Api\AuthorController::class, 'index'])->name('authors.index');
    Route::get('authors/{id}', [\App\Http\Controllers\Api\AuthorController::class, 'show'])->name('authors.show');

});
