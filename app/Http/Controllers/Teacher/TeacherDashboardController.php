<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Fiche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();

        // Statistiques pour les cartes
        $studentCount = $teacher->etudiants()->count();
        $soutenanceCount = $teacher->soutenances()->count();

        // Calculer le nombre de fiches en attente spécifiquement pour cet enseignant
        $fichesEnAttenteCount = Fiche::where('enseignant_id', $teacher->id)
                                     ->where('Remarque', 'en Attente')
                                     ->count();

        // Récupérer les fiches elles-mêmes pour les afficher dans la table
        $fichesEnAttente = Fiche::with('etudiant')
                                ->where('enseignant_id', $teacher->id)
                                ->where('Remarque', 'en Attente')
                                ->latest()
                                ->take(5) // On affiche les 5 plus récentes sur le dashboard
                                ->get();
        
        return view('teacher.dashboard', compact(
            'studentCount', 
            'soutenanceCount', 
            'fichesEnAttenteCount',
            'fichesEnAttente'
        ));
    }
}