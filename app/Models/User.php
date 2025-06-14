<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Enseignant;
use App\Models\Fiche;
use App\Models\Soutenance;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'enseignant_id',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }
    public function fiches(){
        return $this->hasMany(Fiche::class,'etudiant_id');
    }

    /**
     * Obtient la dernière fiche PFE soumise par l'étudiant.
     */
    public function latestFiche(): HasOne
    {
        // C'est une relation "hasOne" qui est une sous-catégorie
        // de la relation "hasMany", mais qui ne retourne que le plus récent.
        return $this->hasOne(Fiche::class, 'etudiant_id')->latestOfMany();
    }
    
    public function soutenance()
    {
        return $this->hasOne(Soutenance::class, 'etudiant_id', 'id');
    }

    public function documents(): HasMany
    {
        // Un User 'a plusieurs' (hasMany) Document.
        // Laravel va chercher une colonne 'user_id' dans la table 'documents'.
        return $this->hasMany(Document::class);
    }
}
