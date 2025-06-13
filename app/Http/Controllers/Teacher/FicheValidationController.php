<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Fiche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FicheValidationController extends Controller
{
    public function listStudents()
    {
        $teacher = Auth::user();
        // Assurez-vous d'avoir une relation 'etudiants' dans votre modèle Enseignant
        $students = $teacher->etudiants()->with('latestFiche')->get(); 
        
        return view('teacher.students.index', ['data' => $students]);
    }

    public function edit(Fiche $fiche)
    {
        $this->authorize('view', $fiche);
        return view('teacher.fiches.edit', ['data' => $fiche]);
    }

    public function update(Request $request, Fiche $fiche)
    {
        $this->authorize('update', $fiche);

        $request->validate(['Remarque' => ['required', 'in:accepte,refuse,en Attente']]);

        $fiche->update(['Remarque' => $request->Remarque]);

        return redirect()->route('teacher.students.index')->with('success', 'Le statut de la fiche a été mis à jour.');
    }
}