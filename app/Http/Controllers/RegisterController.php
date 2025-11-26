<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    // Liste tous les utilisateurs
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return response()->json($users);
    }

    // Crée un nouvel utilisateur
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:admin,user',
            'avatar' => 'nullable|string'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'avatar' => $validated['avatar'] ?? null,
        ]);

        return response()->json([
            'message' => 'Utilisateur créé avec succès',
            'user' => $user
        ], 201);
    }

    // Met à jour un utilisateur
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:100',
            'username' => 'sometimes|string|max:50|unique:users,username,' . $id,
            'password' => 'sometimes|string|min:6|nullable',
            'role' => 'sometimes|string|in:admin,user',
            'avatar' => 'nullable|string'
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'message' => 'Utilisateur mis à jour avec succès',
            'user' => $user
        ]);
    }

    // Supprime un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'Utilisateur supprimé avec succès'
        ]);
    }
}
