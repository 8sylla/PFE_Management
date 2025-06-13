<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale; // Assurez-vous que le nom du modèle est correct
use Illuminate\Http\Request;

class SalleController extends Controller
{
    /**
     * Affiche la liste des salles.
     */
    public function index()
    {
        $data = Sale::latest()->paginate(10);
        return view('admin.salles.index', compact('data'));
    }

    /**
     * Affiche le formulaire de création de salle.
     */
    public function create()
    {
        return view('admin.salles.create');
    }

    /**
     * Enregistre une nouvelle salle.
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero' => ['required', 'string', 'max:255', 'unique:sales,numero'],
            'depatement' => ['nullable', 'string', 'max:255'],
        ]);

        Sale::create($request->all());

        return redirect()->route('admin.salles.index')->with('success', 'Salle créée avec succès.');
    }

    /**
     * Supprime une salle.
     */
    public function destroy(Sale $salle)
    {
        // TODO: Vérifier si la salle n'est pas utilisée dans une soutenance.
        // if ($salle->soutenances()->exists()) {
        //     return back()->withErrors(['error' => 'Cette salle ne peut pas être supprimée car elle est réservée pour une ou plusieurs soutenances.']);
        // }

        $salle->delete();

        return redirect()->route('admin.salles.index')->with('success', 'Salle supprimée avec succès.');
    }
}