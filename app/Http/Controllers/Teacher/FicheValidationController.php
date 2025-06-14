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

        // =================== VÉRIFICATION AJOUTÉE ===================
        if (strtolower($fiche->Remarque) !== 'en attente') {
            return redirect()->route('teacher.fiches.edit', $fiche)
                             ->withErrors(['error' => 'Une décision finale a déjà été prise pour cette fiche. Elle ne peut plus être modifiée.']);
        }
        // ===========================================================

        $request->validate([
            'Remarque' => ['required', 'in:accepte,refuse'], // On retire 'en Attente' des options valides
        ]);

        $fiche->update(['Remarque' => $request->Remarque]);

        return redirect()->route('teacher.students.index')->with('success', 'La décision a été enregistrée avec succès.');
    }
}