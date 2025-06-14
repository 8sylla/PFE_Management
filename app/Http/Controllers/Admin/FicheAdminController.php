<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fiche;
use Illuminate\Http\Request;

class FicheAdminController extends Controller
{
    public function index()
    {
        $fiches = Fiche::with('etudiant', 'enseignant')
                       ->where('Remarque', 'en Attente')
                       ->paginate(15);
        return view('admin.fiches.index', compact('fiches'));
    }
}