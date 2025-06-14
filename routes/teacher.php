<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\TeacherAuthController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Http\Controllers\Teacher\FicheValidationController;
use App\Http\Controllers\Teacher\SoutenanceTeacherController;
use App\Http\Controllers\Teacher\ProfileController;

// Préfixe 'teacher', nom de route 'teacher.'
Route::prefix('teacher')->name('teacher.')->group(function () {
    
    // Routes d'authentification de l'enseignant
    Route::middleware('guest:teacher')->group(function () {
        Route::get('login', [TeacherAuthController::class, 'create'])->name('login');
        Route::post('login', [TeacherAuthController::class, 'store']);
    });

    // Routes protégées pour l'enseignant authentifié
    Route::middleware('auth:teacher')->group(function () {
        Route::post('logout', [TeacherAuthController::class, 'destroy'])->name('logout');
        
        // Dashboard
        Route::get('dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');
        
        // Gestion des étudiants et fiches à valider
        Route::get('etudiants', [FicheValidationController::class, 'listStudents'])->name('students.index');
        Route::get('fiches/{fiche}/valider', [FicheValidationController::class, 'edit'])->name('fiches.edit');
        Route::put('fiches/{fiche}', [FicheValidationController::class, 'update'])->name('fiches.update');

        // Consultation des soutenances
        Route::get('soutenances', [SoutenanceTeacherController::class, 'index'])->name('soutenances.index');

        // Profile
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('password', [ProfileController::class, 'updatePassword'])->name('password.update');
    });
});