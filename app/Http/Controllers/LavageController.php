<?php

namespace App\Http\Controllers;

use App\Models\Lavage;
use Illuminate\Http\Request;

class LavageController extends Controller
{
    public function index()
    {
        return response()->json(Lavage::with('vehicule')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicule_id' => 'required|exists:vehicules,id',
            'date_lavage' => 'required|date',
            'type' => 'nullable|string',
            'effectué_par' => 'nullable|string',
        ]);

        $lavage = Lavage::create($validated);
        return response()->json($lavage, 201);
    }

    public function update(Request $request, $id)
    {
        $lavage = Lavage::findOrFail($id);
        $lavage->update($request->all());
        return response()->json($lavage);
    }

    public function destroy($id)
    {
        Lavage::destroy($id);
        return response()->json(['message' => 'Lavage supprimé avec succès']);
    }
}
