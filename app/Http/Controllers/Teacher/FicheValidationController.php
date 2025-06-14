<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Fiche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FicheValidationController extends Controller
{
    /**
     * Affiche la liste des étudiants de l'enseignant, avec leurs fiches et documents.
     */
    public function listStudents()
    {
        $teacher = Auth::user();
        
        // Pré-charger les relations pour optimiser les requêtes
        $students = $teacher->etudiants()->with(['latestFiche', 'documents'])->get();
        
        return view('teacher.students.index', ['data' => $students]);
    }

    /**
     * Affiche une fiche spécifique pour la valider.
     */
    public function edit(Fiche $fiche)
    {
        $this->authorize('view', $fiche);
        return view('teacher.fiches.edit', ['data' => $fiche]);
    }

    /**
     * Met à jour le statut de la fiche.
     */
    public function update(Request $request, Fiche $fiche)
    {
        $this->authorize('update', $fiche);
        $request->validate(['Remarque' => ['required', 'in:accepte,refuse,en Attente']]);
        $fiche->update(['Remarque' => $request->Remarque]);
        return redirect()->route('teacher.students.index')->with('success', 'Le statut de la fiche a été mis à jour.');
    }
}