<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // 🔹 Lister les utilisateurs
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => User::all()
        ]);
    }

    // 🔹 Ajouter un utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:users',
            'password'  => 'required|string|min:4',
            'role'      => 'required|string',
            'avatar'    => 'nullable|string'
        ]);

        $user = User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'avatar'    => $request->avatar ?? ""
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Utilisateur ajouté avec succès',
            'data' => $user
        ]);
    }

    // 🔹 Mettre à jour un utilisateur
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'      => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:users,username,' . $user->id,
            'password'  => 'nullable|string|min:4',
            'role'      => 'required|string',
            'avatar'    => 'nullable|string'
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->role = $request->role;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->avatar = $request->avatar ?? $user->avatar;

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Utilisateur modifié avec succès',
            'data' => $user
        ]);
    }

    // 🔹 Supprimer un utilisateur
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Utilisateur supprimé avec succès'
        ]);
    }
}
