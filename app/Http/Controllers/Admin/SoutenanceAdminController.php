<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Soutenance;
use App\Models\User;
use App\Models\Jury;
use App\Models\Sale;
use Illuminate\Http\Request;

class SoutenanceAdminController extends Controller
{
    /**
     * Affiche la liste paginée de toutes les soutenances.
     */
    public function index()
    {
        $soutenances = Soutenance::with(['etudiant', 'enseignant', 'jury', 'sale'])
                                 ->latest('date')
                                 ->paginate(15);
        return view('admin.soutenances.index', compact('soutenances'));
    }

    /**
     * Affiche le formulaire pour planifier une nouvelle soutenance.
     */
    public function create(Request $request)
    {
        // On ne propose que les étudiants qui n'ont pas encore de soutenance planifiée.
        $etudiants = User::doesntHave('soutenance')->orderBy('name')->get();
        
        $jurys = Jury::orderBy('name')->get();
        $salles = Sale::orderBy('numero')->get();
        $selectedStudent = null;
        $encadrent = null;

        if ($request->filled('etudiant_id')) {
            $selectedStudent = User::with('enseignant')->findOrFail($request->etudiant_id);
            $encadrent = $selectedStudent->enseignant;
        }

        return view('admin.soutenances.create', compact('etudiants', 'jurys', 'salles', 'selectedStudent', 'encadrent'));
    }

    /**
     * Enregistre une nouvelle soutenance dans la base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => ['required', 'date'],
            'etudiant_id' => ['required', 'exists:users,id', 'unique:soutenances,etudiant_id'],
            'salle_id' => ['required', 'exists:sales,id'],
            'jury_id' => ['required', 'exists:juries,id'],
        ]);

        $etudiant = User::find($request->etudiant_id);

        Soutenance::create([
            'date' => $request->date,
            'etudiant_id' => $request->etudiant_id,
            'enseignant_id' => $etudiant->enseignant_id,
            'salle_id' => $request->salle_id,
            'jury_id' => $request->jury_id,
        ]);

        return redirect()->route('admin.soutenances.index')->with('success', 'Soutenance planifiée avec succès.');
    }
    
    /**
     * Affiche le formulaire pour modifier et noter une soutenance.
     */
    public function edit(Soutenance $soutenance)
    {
        $jurys = Jury::all();
        $salles = Sale::all();
        // Le modèle $soutenance est automatiquement injecté par Laravel (Route Model Binding)
        return view('admin.soutenances.edit', ['data' => $soutenance, 'jurys' => $jurys, 'salles' => $salles]);
    }
    
    /**
     * Met à jour les informations d'une soutenance, y compris la note.
     */
    public function update(Request $request, Soutenance $soutenance)
    {
        
        $validated = $request->validate([
            'date' => ['required', 'date'],
            'salle_id' => ['required', 'exists:sales,id'],
            'jury_id' => ['required', 'exists:juries,id'],
            'note' => ['nullable', 'numeric', 'min:0', 'max:20'], // La note est optionnelle
        ]);

        $soutenance->update($validated);

        return redirect()->route('admin.soutenances.index')->with('success', 'Soutenance mise à jour avec succès.');
    }
    
    /**
     * Supprime une soutenance planifiée.
     */
    public function destroy(Soutenance $soutenance)
    {
        $soutenance->delete();
        return redirect()->route('admin.soutenances.index')->with('success', 'Soutenance annulée avec succès.');
    }
}