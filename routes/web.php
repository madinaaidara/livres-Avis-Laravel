<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// Page d'accueil redirige vers la liste des livres
Route::redirect('/', '/books');

// Routes pour les livres
Route::controller(BookController::class)->group(function () {
    Route::get('/books', 'index')->name('books.index');
    Route::get('/books/{book}', 'show')->name('books.show');
});

// Routes pour les avis
Route::controller(ReviewController::class)->group(function () {
Route::post('/books/{book}/reviews', 'store')->name('books.reviews.store');
    Route::put('/reviews/{review}', 'update')->name('reviews.update');
    Route::delete('/reviews/{review}', 'destroy')->name('reviews.destroy');
});


Route::fallback(function () {
    return view('errors.404');
});