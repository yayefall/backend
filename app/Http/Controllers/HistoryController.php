<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Récupérer l'historique avec filtres et pagination
     */
    public function index(Request $request)
    {
        $query = History::query();

        // FILTRES
        if ($request->filled('table')) {
            $query->where('table_name', $request->table);
        }

        if ($request->filled('user')) {
            $query->where('username', 'like', '%' . $request->user . '%');
        }

        if ($request->filled('startDate')) {
            $query->whereDate('created_at', '>=', $request->startDate);
        }

        if ($request->filled('endDate')) {
            $query->whereDate('created_at', '<=', $request->endDate);
        }

        // PAGINATION
        $perPage = $request->get('perPage', 10);
        $history = $query->orderBy('created_at', 'desc')->paginate($perPage);

        // Réponse optimisée pour Vue.js
        return response()->json([
            'data' => $history->items(),
            'currentPage' => $history->currentPage(),
            'perPage' => $history->perPage(),
            'totalItems' => $history->total(),
            'totalPages' => $history->lastPage()
        ]);
    }

    /**
     * Créer un historique
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_name' => 'required|string',
            'action' => 'required|in:create,update,delete',
            'record_id' => 'required|integer',
            'username' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $history = History::create($validated);

        return response()->json($history, 201);
    }

    /**
     * Mettre à jour un historique
     */
    public function update(Request $request, $id)
    {
        $history = History::findOrFail($id);
        $history->update($request->all());

        return response()->json($history);
    }

    /**
     * Supprimer un historique
     */
    public function destroy($id)
    {
        History::destroy($id);

        return response()->json(['message' => 'Historique supprimé avec succès']);
    }
}
