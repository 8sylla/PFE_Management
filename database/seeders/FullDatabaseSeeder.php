<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Enseignant;
use App\Models\Jury;
use App\Models\Sale; // Assurez-vous que le nom du modèle est bien 'Sale' pour la table 'sales'
use App\Models\User;
use App\Models\Fiche;
use App\Models\Soutenance;

class FullDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Désactiver temporairement les contraintes de clés étrangères pour le TRUNCATE
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Vider les tables dans l'ordre inverse des dépendances
        Soutenance::truncate();
        Fiche::truncate();
        User::truncate();
        Sale::truncate();
        Jury::truncate();
        Enseignant::truncate();
        Admin::truncate();

        // Réactiver les contraintes de clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // --- 1. Création des Données Primaires (sans dépendances) ---

        // Seed Admin
        Admin::create([
            'name' => 'Admin ENSAT',
            'email' => 'admin.pfe@uae.ac.ma',
            'password' => Hash::make('password'), // Mot de passe simple pour le test
        ]);

        // Seed Enseignants (avec les données réalistes)
        $enseignantsData = [
    ['name' => 'Dr. Nadia El Fassi', 'email' => 'nadia.elfassi@uae.ac.ma', 'specialite' => 'Génie Informatique (IA & Data Science)'],
    ['name' => 'Pr. Youssef Alaoui', 'email' => 'youssef.alaoui@uae.ac.ma', 'specialite' => 'Génie des Systèmes de Télécoms et Réseaux'],
    ['name' => 'Dr. Salma Benjelloun', 'email' => 'salma.benjelloun@uae.ac.ma', 'specialite' => 'Génie Industriel et Logistique (GIL)'],
    ['name' => 'Pr. Karim Saidi', 'email' => 'karim.saidi@uae.ac.ma', 'specialite' => 'Génie Informatique (Développement Web & Mobile)'],
    ['name' => 'Dr. Omar Cherkaoui', 'email' => 'omar.cherkaoui@uae.ac.ma', 'specialite' => 'Génie des Systèmes Électroniques et Automatique'],
        ];

        foreach ($enseignantsData as $data) {
            // --- AJOUTEZ LA LIGNE SUIVANTE ---
            $data['password'] = Hash::make('password'); // Mot de passe par défaut 'password'
            
            Enseignant::create($data); // Crée l'enseignant avec toutes les infos requises
        }

        // Seed Jurys
        $juriesData = [
            ['name' => 'Jury PFE-GI-01'],
            ['name' => 'Jury PFE-GIL-02'],
            ['name' => 'Jury PFE-GSTR-03'],
            ['name' => 'Jury PFE-GSEA-04'],
        ];
        foreach ($juriesData as $data) {
            Jury::create($data);
        }

        // Seed Salles
        $sallesData = [
            ['numero' => 'Amphithéâtre A', 'depatement' => 'Tronc Commun'],
            ['numero' => 'Salle B-101', 'depatement' => 'Génie Informatique'],
            ['numero' => 'Salle de Conférences', 'depatement' => 'Administration'],
            ['numero' => 'Labo GSTR', 'depatement' => 'Télécoms et Réseaux'],
        ];
        foreach ($sallesData as $data) {
            Sale::create($data);
        }

        // --- 2. Récupération des IDs pour les relations ---
        $enseignantIds = Enseignant::pluck('id');
        $juryIds = Jury::pluck('id');
        $salleIds = Sale::pluck('id');

        // --- 3. Création des Données Dépendantes (Étudiants, Fiches, Soutenances) ---

        // Seed Users (étudiants)
        $etudiantsData = [
            'Aya El Moussaoui', 'Yassine Cherradi', 'Fatima Zahra Bennani', 'Mehdi Alaoui', 'Sofia Guessous',
            'Amine Kadiri', 'Lina Berrada', 'Adam Saadi', 'Kenza Fassi', 'Othmane Alami'
        ];
        
        foreach ($etudiantsData as $nom) {
            $email = strtolower(str_replace(' ', '.', $nom)) . '@etu.uae.ac.ma';
            User::create([
                'name' => $nom,
                'image' => 'default_profile.png', // Une image par défaut
                'email' => $email,
                'email_verified_at' => now(), // On considère les emails comme vérifiés pour le test
                'password' => Hash::make('password'),
                'enseignant_id' => $enseignantIds->random(), // Assignation d'un encadrant aléatoire
            ]);
        }
        $etudiantIds = User::pluck('id');

        // Seed Fiches PFE
        $societes = ['OCP Group', 'Capgemini', 'CGI Maroc', 'Attijariwafa Bank', 'Yazaki Kenitra', 'Sofrecom', 'Inwi', 'Orange Maroc'];
        $intitules = [
            'Développement d\'une plateforme de E-learning adaptatif', 'Optimisation de la chaîne logistique par l\'IA',
            'Mise en place d\'un data lake pour l\'analyse prédictive', 'Conception d\'une application mobile pour la gestion de flottes',
            'Sécurisation d\'une infrastructure Cloud pour une application SaaS', 'Système IoT pour la maintenance prédictive industrielle',
            'Analyse de sentiment sur les réseaux sociaux pour une marque', 'Développement d\'une API RESTful pour un service bancaire'
        ];

        foreach ($etudiantIds as $etudiantId) {
            Fiche::create([
                'societe_acceuil' => $societes[array_rand($societes)],
                'encadrant_externe' => 'Mr. / Mme. ' . ['Dupont', 'Martin', 'Bernard'][array_rand(['Dupont', 'Martin', 'Bernard'])],
                'ntel_societe' => '05' . rand(10000000, 99999999),
                'mail_societe' => 'contact@' . strtolower(str_replace(' ', '', $societes[array_rand($societes)])) . '.com',
                'intitule_pfe' => $intitules[array_rand($intitules)],
                'besions_fonctionnels' => 'Analyse des besoins, Conception UML, Développement, Tests et Déploiement.',
                'technologies_utilisees' => ['Laravel, React, PostgreSQL', 'Django, Vue.js, MySQL', 'Spring Boot, Angular, MongoDB'][array_rand([0,1,2])],
                'langue' => 'Français',
                'Remarque' => ['en Attente', 'Validé', 'Refusé'][array_rand([0,1,2])], // Statut aléatoire
                'enseignant_id' => $enseignantIds->random(),
                'etudiant_id' => $etudiantId,
            ]);
        }

        // Seed Soutenances
        foreach ($etudiantIds as $etudiantId) {
            // Créer une soutenance seulement pour la moitié des étudiants pour plus de réalisme
            if (rand(0, 1)) {
                Soutenance::create([
                    'date' => now()->addDays(rand(5, 30))->addHours(rand(9, 16)),
                    'note' => round(rand(1200, 1950) / 100, 2), // Note entre 12.00 et 19.50
                    'salle_id' => $salleIds->random(),
                    'etudiant_id' => $etudiantId,
                    'enseignant_id' => Enseignant::find(User::find($etudiantId)->enseignant_id)->id, // L'encadrant de l'étudiant
                    'jury_id' => $juryIds->random(),
                ]);
            }
        }
    }
}