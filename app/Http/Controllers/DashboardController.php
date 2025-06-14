<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function studentDashboard()
    // {
    //     $user = Auth::user();

    //     // Vous pouvez passer ici des données spécifiques au dashboard de l'étudiant si nécessaire.
    //     // Par exemple, le statut de sa fiche ou la date de sa soutenance.
    //     $fiche = $user->fiches()->latest()->first();
    //     $soutenance = $user->soutenance;

    //     // Le nom de la vue originale était 'layouts.palnnig', je vais le garder pour l'instant.
    //     // Il serait bon de le renommer en 'student.dashboard' pour plus de clarté.
    //     return view('student.dashboard', compact('fiche', 'soutenance'));
    // }

//     public function studentDashboard() {
//     $user = Auth::user();
//     $fiche = $user->latestFiche;
//     $soutenance = $user->soutenance;
//     return view('student.dashboard', compact('user', 'fiche', 'soutenance'));
// }

public function studentDashboard()
    {
        $user = Auth::user(); // L'utilisateur authentifié (étudiant)
        
        // On charge les relations pour les utiliser dans la vue
        $user->load('enseignant', 'latestFiche', 'soutenance'); 
        $fiche = $user->latestFiche;
        $soutenance = $user->soutenance;
        
        $isCompleted = $soutenance && !is_null($soutenance->note);
        // =======================================================

        return view('student.dashboard', [
            'user' => $user,
            'fiche' => $fiche,
            'soutenance' => $soutenance,
            'isCompleted' => $isCompleted, // On passe la nouvelle variable à la vue
        ]);
    }
}
