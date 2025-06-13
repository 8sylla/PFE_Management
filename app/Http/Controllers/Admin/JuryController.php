<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jury;
use Illuminate\Http\Request;

class JuryController extends Controller
{
    /**
     * Affiche la liste des jurys.
     */
    public function index()
    {
        $data = Jury::latest()->paginate(12); // Paginer par 12 pour une grille 3x4
        return view('admin.jurys.index', compact('data'));
    }

    /**
     * Affiche le formulaire de création de jury.
     */
    public function create()
    {
        return view('admin.jurys.create');
    }

    /**
     * Enregistre un nouveau jury.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:juries,name'],
        ]);

        Jury::create($request->only('name'));

        return redirect()->route('admin.jurys.index')->with('success', 'Jury créé avec succès.');
    }

    /**
     * Supprime un jury.
     */
    public function destroy(Jury $jury)
    {
        // TODO: Ajouter une vérification pour s'assurer que le jury n'est pas utilisé dans une soutenance planifiée.
        // if ($jury->soutenances()->exists()) {
        //     return back()->withErrors(['error' => 'Ce jury ne peut pas être supprimé car il est assigné à une ou plusieurs soutenances.']);
        // }
        
        $jury->delete();

        return redirect()->route('admin.jurys.index')->with('success', 'Jury supprimé avec succès.');
    }
}