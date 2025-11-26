<?php

namespace App\Http\Controllers;

use App\Models\Entretien;
use Illuminate\Http\Request;

class EntretienController extends Controller
{
    public function index()
    {
        return response()->json(Entretien::with('vehicule')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicule_id' => 'required|exists:vehicules,id',
            'date_entretien' => 'required|date',
            'type' => 'required|string',
            'remarques' => 'nullable|string',
        ]);

        $entretien = Entretien::create($validated);
        return response()->json($entretien, 201);
    }

    public function update(Request $request, $id)
    {
        $entretien = Entretien::findOrFail($id);
        $entretien->update($request->all());
        return response()->json($entretien);
    }

    public function destroy($id)
    {
        Entretien::destroy($id);
        return response()->json(['message' => 'Entretien supprimé avec succès']);
    }
}
