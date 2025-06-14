<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoutenanceTeacherController extends Controller
{
    /**
     * Affiche la liste des soutenances encadrées par l'enseignant authentifié.
     */
    public function index()
    {
        $teacher = Auth::user();
        
        // Récupérer les soutenances où l'enseignant est l'encadrant
        $soutenances = $teacher->soutenances()
                               ->with(['etudiant', 'jury', 'sale'])
                               ->latest('date')
                               ->paginate(15);
        
        return view('teacher.soutenances.index', compact('soutenances'));
    }
}