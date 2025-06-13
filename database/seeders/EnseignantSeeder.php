<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Si vous stockez aussi un mot de passe par défaut

class EnseignantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vider la table avant de la remplir pour éviter les doublons lors de ré-exécutions
        DB::table('enseignants')->truncate();

        $enseignants = [
            ['name' => 'Dr. Nadia El Fassi', 'email' => 'nadia.elfassi@uae.ac.ma', 'specialite' => 'Génie Informatique (IA & Data Science)'],
            ['name' => 'Pr. Youssef Alaoui', 'email' => 'youssef.alaoui@uae.ac.ma', 'specialite' => 'Génie des Systèmes de Télécoms et Réseaux'],
            ['name' => 'Dr. Salma Benjelloun', 'email' => 'salma.benjelloun@uae.ac.ma', 'specialite' => 'Génie Industriel et Logistique (GIL)'],
            ['name' => 'Pr. Karim Saidi', 'email' => 'karim.saidi@uae.ac.ma', 'specialite' => 'Génie Informatique (Développement Web & Mobile)'],
            ['name' => 'Dr. Omar Cherkaoui', 'email' => 'omar.cherkaoui@uae.ac.ma', 'specialite' => 'Génie des Systèmes Électroniques et Automatique'],
            ['name' => 'Pr. Fatima Zohra Tazi', 'email' => 'fz.tazi@uae.ac.ma', 'specialite' => 'Sciences des Données et Cloud Computing'],
            ['name' => 'Dr. Amine Bennani', 'email' => 'amine.bennani@uae.ac.ma', 'specialite' => 'Génie Industriel (Qualité & Maintenance)'],
            ['name' => 'Pr. Rachid Ouazzani', 'email' => 'rachid.ouazzani@uae.ac.ma', 'specialite' => 'Génie Énergétique et Environnement'],
            ['name' => 'Dr. Hajar Lamrini', 'email' => 'hajar.lamrini@uae.ac.ma', 'specialite' => 'Génie des Systèmes de Télécoms (Sécurité)'],
            ['name' => 'Pr. Ismail Lazaar', 'email' => 'ismail.lazaar@uae.ac.ma', 'specialite' => 'Génie Informatique (Systèmes Embarqués & IoT)'],
        ];

        // Ajouter la date de création/mise à jour
        foreach ($enseignants as &$enseignant) {
            $enseignant['created_at'] = now();
            $enseignant['updated_at'] = now();
        }

        // Insérer les données dans la base de données
        DB::table('enseignants')->insert($enseignants);
    }
}