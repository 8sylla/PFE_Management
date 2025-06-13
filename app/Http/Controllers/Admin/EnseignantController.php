<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enseignant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class EnseignantController extends Controller
{
    public function index()
    {
        $data = Enseignant::latest()->paginate(10);
        return view('admin.enseignants.index', compact('data'));
    }

    public function create()
    {
        return view('admin.enseignants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:enseignants'],
            'specialite' => ['nullable', 'string', 'max:255'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        Enseignant::create([
            'name' => $request->name,
            'email' => $request->email,
            'specialite' => $request->specialite,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.enseignants.index')->with('success', 'Encadrant ajouté avec succès.');
    }

    public function edit(Enseignant $enseignant)
    {
        return view('admin.enseignants.edit', ['data' => $enseignant]);
    }

    public function update(Request $request, Enseignant $enseignant)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:enseignants,email,' . $enseignant->id],
            'specialite' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $enseignant->fill($request->only(['name', 'email', 'specialite']));

        if ($request->filled('password')) {
            $enseignant->password = Hash::make($request->password);
        }
        
        $enseignant->save();

        return redirect()->route('admin.enseignants.index')->with('success', 'Informations de l\'encadrant mises à jour.');
    }

    public function destroy(Enseignant $enseignant)
    {
        // TODO: Ajouter une vérification (ex: si l'enseignant a des étudiants assignés)
        $enseignant->delete();
        return redirect()->route('admin.enseignants.index')->with('success', 'Encadrant supprimé avec succès.');
    }
}