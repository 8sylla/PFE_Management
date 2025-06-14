<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiche extends Model
{
    use HasFactory;

    // Assurez-vous que votre propriété $fillable ou $guarded est correcte
    protected $guarded = []; // ou protected $fillable = [...];

    /**
     * Définit la relation "une fiche appartient à un étudiant".
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function etudiant()
    {
        // Une Fiche 'appartient à' (belongsTo) un User.
        // Laravel va chercher une colonne 'user_id' par défaut.
        // Si votre colonne s'appelle 'etudiant_id', vous devez le spécifier.
        return $this->belongsTo(User::class, 'etudiant_id');
    }

    /**
     * Définit la relation "une fiche appartient à un enseignant".
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enseignant()
    {
        // Une Fiche 'appartient à' (belongsTo) un Enseignant.
        return $this->belongsTo(Enseignant::class, 'enseignant_id');
    }
}