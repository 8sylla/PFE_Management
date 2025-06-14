<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FicheController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SoutenanceController;
use App\Http\Controllers\DocumentController;

// Page d'accueil publique
Route::get('/', function () {
    return view('welcome');
});

// Routes pour les utilisateurs authentifiés (étudiants)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Tableau de bord de l'étudiant
    Route::get('/dashboard', [DashboardController::class, 'studentDashboard'])->name('dashboard');

    // Gestion du profil (commun à tous les utilisateurs authentifiés)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestion de la fiche PFE par l'étudiant
    Route::get('/ma-fiche', [FicheController::class, 'show'])->name('fiche.show');
    Route::get('/ma-fiche/creer', [FicheController::class, 'create'])->name('fiche.create');
    Route::post('/ma-fiche', [FicheController::class, 'store'])->name('fiche.store');
    Route::get('/ma-fiche/pdf', [FicheController::class, 'generatePDF'])->name('fiche.pdf');
    
    // Consultation de la soutenance par l'étudiant
    Route::get('/ma-soutenance', [SoutenanceController::class, 'showStudentSoutenance'])->name('soutenance.student.show');


    // ... autres routes ...
    Route::resource('documents', DocumentController::class)->only(['index', 'store', 'destroy']);
});

// Inclure les fichiers de routes spécifiques
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/teacher.php';