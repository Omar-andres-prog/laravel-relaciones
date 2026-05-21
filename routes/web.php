<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rutas resource para autores, perfiles y libros
Route::apiResource('authors', AuthorController::class);
Route::apiResource('profiles', ProfileController::class);
Route::apiResource('books', BookController::class);

// Rutas de relaciones — Relación 1:1
Route::get('/authors/{id}/profile', [AuthorController::class, 'profile']);
Route::get('/profiles/{id}/author', [ProfileController::class, 'author']);

// Rutas de relaciones — Relación 1:N
Route::get('/authors/{id}/books', [AuthorController::class, 'books']);
Route::get('/books/{id}/author', [BookController::class, 'author']);
