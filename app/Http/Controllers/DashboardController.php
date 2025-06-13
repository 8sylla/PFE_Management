<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function studentDashboard()
    {
        $user = Auth::user();

        // Vous pouvez passer ici des données spécifiques au dashboard de l'étudiant si nécessaire.
        // Par exemple, le statut de sa fiche ou la date de sa soutenance.
        $fiche = $user->fiches()->latest()->first();
        $soutenance = $user->soutenance;

        // Le nom de la vue originale était 'layouts.palnnig', je vais le garder pour l'instant.
        // Il serait bon de le renommer en 'student.dashboard' pour plus de clarté.
        return view('layouts.palnnig', compact('fiche', 'soutenance'));
    }
}
