<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(): JsonResponse
    {
        $authors = Author::all();

        return response()->json($authors);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre'    => 'required|string|max:100',
            'apellidos' => 'required|string|max:150',
            'email'     => 'required|email|unique:authors,email',
        ]);

        $author = Author::create($validated);

        return response()->json($author, 201);
    }

    public function show(string $id): JsonResponse
    {
        $author = Author::findOrFail($id);

        return response()->json($author);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $author = Author::findOrFail($id);

        $validated = $request->validate([
            'nombre'    => 'sometimes|string|max:100',
            'apellidos' => 'sometimes|string|max:150',
            'email'     => 'sometimes|email|unique:authors,email,' . $id,
        ]);

        $author->update($validated);

        return response()->json($author);
    }

    public function destroy(string $id): JsonResponse
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return response()->json(null, 204);
    }

    // GET /authors/{id}/profile — Relación 1:1
    public function profile(string $id): JsonResponse
    {
        $author = Author::findOrFail($id);

        return response()->json([
            'author'  => $author,
            'profile' => $author->profile,
        ]);
    }

    // GET /authors/{id}/books — Relación 1:N
    public function books(string $id): JsonResponse
    {
        $author = Author::findOrFail($id);

        return response()->json([
            'author' => $author,
            'books'  => $author->books,
        ]);
    }
}
