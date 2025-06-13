<?php

namespace App\Policies;

use App\Models\Fiche;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FichePolicy
{
    public function view(Enseignant $enseignant, Fiche $fiche): bool
    {
        return $enseignant->id === $fiche->etudiant->enseignant_id;
    }
    public function update(Enseignant $enseignant, Fiche $fiche): bool
    {
        return $enseignant->id === $fiche->etudiant->enseignant_id;
    }
}
