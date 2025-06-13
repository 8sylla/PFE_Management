<?php

namespace App\Http\Controllers;

use App\Models\Fiche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class FicheController extends Controller
{
    public function show()
    {
        $etudiant = Auth::user();
        $fiche = $etudiant->fiches()->latest()->first();

        if (!$fiche) {
            return view('student.fiche.show')->with('message', 'Vous n\'avez pas encore soumis de fiche PFE.');
        }

        return view('student.fiche.show', compact('fiche'));
    }

    public function create()
    {
        $user = Auth::user();
        // On ne passe que l'enseignant de l'étudiant connecté
        $enseignant = $user->enseignant;
        return view('student.fiche.create', compact('user', 'enseignant'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'enseignant_id' => 'required|exists:enseignants,id',
            'societe_acceuil' => 'required|string|max:255',
            'encadrant_externe' => 'required|string|max:255',
            'ntel_societe' => 'required|string|max:20',
            'mail_societe' => 'required|email|max:255',
            'intitule_pfe' => 'required|string|max:255',
            'besions_fonctionnels' => 'required|string',
            'technologies_utilisees' => 'required|string',
            'langue' => 'required|string|in:Francais,Anglais',
        ]);
        
        // Ajouter l'ID de l'étudiant authentifié
        $validatedData['etudiant_id'] = Auth::id();

        Fiche::create($validatedData);

        return redirect()->route('fiche.show')->with('success', 'Votre fiche PFE a été soumise avec succès ! Elle est en attente de validation.');
    }

    public function generatePDF()
    {
        $fiche = Auth::user()->fiches()->latest()->first();
        if (!$fiche || $fiche->Remarque !== 'accepte') {
            abort(403, 'Vous ne pouvez télécharger que les fiches acceptées.');
        }
        
        $pdf = Pdf::loadView('student.fiche.pdf', compact('fiche'));
        return $pdf->download('fiche-pfe-' . Auth::user()->name . '.pdf');
    }
}