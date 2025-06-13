<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enseignant;
use App\Models\Soutenance;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $studentCount = User::count();
        $teachersCount = Enseignant::count();
        $soutenanceCount = Soutenance::count();
        $recentStudents = User::latest()->take(5)->get(); // Exemple de données pour le widget

        return view('admin.dashboard', compact('studentCount', 'teachersCount', 'soutenanceCount', 'recentStudents'));
    }
}