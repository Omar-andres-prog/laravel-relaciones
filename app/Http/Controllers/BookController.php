<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        $books = Book::with('author')->get();

        return response()->json($books);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'author_id'        => 'required|exists:authors,id',
            'titulo'           => 'required|string|max:200',
            'isbn'             => 'required|string|max:20|unique:books,isbn',
            'precio'           => 'required|numeric|min:0',
            'anio_publicacion' => 'required|integer|min:1000|max:9999',
        ]);

        $book = Book::create($validated);

        return response()->json($book, 201);
    }

    public function show(string $id): JsonResponse
    {
        $book = Book::with('author')->findOrFail($id);

        return response()->json($book);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'titulo'           => 'sometimes|string|max:200',
            'isbn'             => 'sometimes|string|max:20|unique:books,isbn,' . $id,
            'precio'           => 'sometimes|numeric|min:0',
            'anio_publicacion' => 'sometimes|integer|min:1000|max:9999',
        ]);

        $book->update($validated);

        return response()->json($book);
    }

    public function destroy(string $id): JsonResponse
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(null, 204);
    }

    // GET /books/{id}/author — Relación 1:N inversa
    public function author(string $id): JsonResponse
    {
        $book = Book::findOrFail($id);

        return response()->json([
            'book'   => $book,
            'author' => $book->author,
        ]);
    }
}
