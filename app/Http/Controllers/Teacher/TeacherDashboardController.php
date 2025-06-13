<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();
        $studentCount = $teacher->etudiants()->count();
        $soutenanceCount = $teacher->soutenances()->count();

        return view('teacher.dashboard', compact('studentCount', 'soutenanceCount'));
    }
}