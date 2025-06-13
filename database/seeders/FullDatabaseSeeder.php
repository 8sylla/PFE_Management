<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FullDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Admin
        DB::table('admins')->insert([
            'name' => 'Admin Principal',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seed Enseignants
        for ($i = 1; $i <= 5; $i++) {
            DB::table('enseignants')->insert([
                'name' => "Enseignant $i",
                'email' => "enseignant$i@example.com",
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Seed Juries
        for ($i = 1; $i <= 5; $i++) {
            DB::table('juries')->insert([
                'name' => "Jury $i",
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Seed Sales
        for ($i = 1; $i <= 3; $i++) {
            DB::table('sales')->insert([
                'numero' => "Salle $i",
                'depatement' => "Informatique",
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Seed Users (étudiants)
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'name' => "Etudiant $i",
                'image' => "image$i.png",
                'email' => "etudiant$i@example.com",
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'enseignant_id' => rand(1, 5),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Seed Fiches
        for ($i = 1; $i <= 10; $i++) {
            DB::table('fiches')->insert([
                'societe_acceuil' => "Société $i",
                'encadrant_externe' => "Encadrant $i",
                'ntel_societe' => "05" . rand(10000000, 99999999),
                'mail_societe' => "societe$i@example.com",
                'intitule_pfe' => "Projet PFE $i",
                'besions_fonctionnels' => "Besoins $i",
                'technologies_utilisees' => "Laravel, PostgreSQL",
                'langue' => "Français",
                'Remarque' => 'en Attente',
                'enseignant_id' => rand(1, 5),
                'etudiant_id' => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Seed Soutenances
        for ($i = 1; $i <= 10; $i++) {
            DB::table('soutenances')->insert([
                'date' => now()->addDays($i),
                'note' => rand(10, 20),
                'salle_id' => rand(1, 3),
                'etudiant_id' => $i,
                'enseignant_id' => rand(1, 5),
                'jury_id' => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
