<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// --- Assurez-vous d'importer la façade Auth ---
use Illuminate\Support\Facades\Auth; 

class SoutenanceController extends Controller
{
    /**
     * Affiche les détails de la soutenance pour l'étudiant authentifié.
     *
     * @return \Illuminate\View\View
     */
    public function showStudentSoutenance()
    {
        // Récupérer l'étudiant connecté
        $etudiant = Auth::user();

        // Récupérer la soutenance associée à cet étudiant
        // La méthode with() pré-charge les relations pour éviter les requêtes N+1
        $soutenance = $etudiant->soutenance()->with(['enseignant', 'jury', 'sale'])->first();

        // Renommer la vue pour plus de clarté
        // 'layouts.studentsoutenance' -> 'student.soutenance.show'
        return view('student.soutenance.show', compact('soutenance'));
    }
}