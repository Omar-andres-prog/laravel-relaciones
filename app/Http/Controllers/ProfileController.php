<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(): JsonResponse
    {
        $profiles = Profile::with('author')->get();

        return response()->json($profiles);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'author_id'        => 'required|exists:authors,id',
            'biografia'        => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'nacionalidad'     => 'required|string|max:100',
        ]);

        $profile = Profile::create($validated);

        return response()->json($profile, 201);
    }

    public function show(string $id): JsonResponse
    {
        $profile = Profile::with('author')->findOrFail($id);

        return response()->json($profile);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $profile = Profile::findOrFail($id);

        $validated = $request->validate([
            'biografia'        => 'sometimes|string',
            'fecha_nacimiento' => 'sometimes|date',
            'nacionalidad'     => 'sometimes|string|max:100',
        ]);

        $profile->update($validated);

        return response()->json($profile);
    }

    public function destroy(string $id): JsonResponse
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return response()->json(null, 204);
    }

    // GET /profiles/{id}/author — Relación 1:1 inversa
    public function author(string $id): JsonResponse
    {
        $profile = Profile::findOrFail($id);

        return response()->json([
            'profile' => $profile,
            'author'  => $profile->author,
        ]);
    }
}
