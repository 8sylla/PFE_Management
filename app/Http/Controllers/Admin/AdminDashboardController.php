<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enseignant;
use App\Models\Soutenance;
use App\Models\Fiche;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $studentCount = User::count();
        $teachersCount = Enseignant::count();
        $soutenanceCount = Soutenance::count();
        $recentStudents = User::latest()->take(5)->get(); 
        $fichesEnAttenteCount = Fiche::where('Remarque', 'en Attente')->count();


        return view('admin.dashboard', compact(
            'studentCount', 
            'teachersCount', 
            'soutenanceCount', 
            'recentStudents',
            'fichesEnAttenteCount' 
        ));
    }
}