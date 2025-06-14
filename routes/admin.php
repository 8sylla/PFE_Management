<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\EnseignantController;
use App\Http\Controllers\Admin\JuryController;
use App\Http\Controllers\Admin\SalleController;
use App\Http\Controllers\Admin\SoutenanceAdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController; 
use App\Http\Controllers\Admin\FicheAdminController;

// Préfixe 'admin', nom de route 'admin.' 
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Routes d'authentification de l'admin (accessibles aux invités)
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'create'])->name('login');
        Route::post('login', [AdminAuthController::class, 'store']);
    });

    // Routes protégées pour l'admin authentifié
    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [AdminAuthController::class, 'destroy'])->name('logout');
        
        // Dashboard
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Gestion des Encadrants (CRUD complet)
        Route::resource('enseignants', EnseignantController::class)->except(['show']);

        // Gestion des Jurys
        Route::resource('jurys', JuryController::class)->only(['index', 'create', 'store', 'destroy']);

        // Gestion des Salles
        Route::resource('salles', SalleController::class)->only(['index', 'create', 'store', 'destroy']);
        
        // Gestion des Soutenances
        Route::get('soutenances', [SoutenanceAdminController::class, 'index'])->name('soutenances.index');
        Route::get('soutenances/planifier', [SoutenanceAdminController::class, 'create'])->name('soutenances.create');
        Route::post('soutenances', [SoutenanceAdminController::class, 'store'])->name('soutenances.store');
        Route::get('soutenances/{soutenance}/modifier', [SoutenanceAdminController::class, 'edit'])->name('soutenances.edit');
        Route::put('soutenances/{soutenance}', [SoutenanceAdminController::class, 'update'])->name('soutenances.update');
        Route::delete('soutenances/{soutenance}', [SoutenanceAdminController::class, 'destroy'])->name('soutenances.destroy');

        // Profile

        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('password', [ProfileController::class, 'updatePassword'])->name('password.update');

        // Gestion des Étudiants
    Route::get('etudiants', [UserController::class, 'index'])->name('users.index');
    Route::get('etudiants/{user}', [UserController::class, 'show'])->name('users.show');
    
    // Gestion des Fiches PFE
    Route::get('fiches', [FicheAdminController::class, 'index'])->name('fiches.index');
    });
});