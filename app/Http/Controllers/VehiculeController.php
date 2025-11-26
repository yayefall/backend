<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    public function index()
    {
        $vehicules = Vehicule::with('driver')->get();
        return response()->json($vehicules);
    }

    public function show($id)
    {
        $vehicule = Vehicule::with(['driver', 'lavages', 'entretiens'])->findOrFail($id);
        return response()->json($vehicule);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'immatriculation' => 'required|string|unique:vehicules',
            'marque' => 'required|string',
            'modele' => 'required|string',
            'annee' => 'nullable|integer',
            'couleur' => 'nullable|string',
            'driver_id' => 'nullable|exists:drivers,id',
            'statut' => 'nullable|string',
            'remarques' => 'nullable|string',
        ]);

        $vehicule = Vehicule::create($validated);
        return response()->json($vehicule, 201);
    }

    public function update(Request $request, $id)
    {
        $vehicule = Vehicule::findOrFail($id);
        $vehicule->update($request->all());
        return response()->json($vehicule);
    }

    public function destroy($id)
    {
        Vehicule::destroy($id);
        return response()->json(['message' => 'Véhicule supprimé avec succès']);
    }
}
