<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        return response()->json(Driver::all());
    }

    public function show($id)
    {
        $driver = Driver::findOrFail($id);
        return response()->json($driver);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'nullable|string|max:100',
            'telephone' => 'nullable|string|max:20',
            'permis' => 'nullable|string|max:50',
        ]);

        $driver = Driver::create($validated);
        return response()->json($driver, 201);
    }

    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);
        $driver->update($request->all());
        return response()->json($driver);
    }

    public function destroy($id)
    {
        Driver::destroy($id);
        return response()->json(['message' => 'Chauffeur supprimé avec succès']);
    }
}
