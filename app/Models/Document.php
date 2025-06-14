<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'description',
        'file_name',
        'file_path',
    ];

    /**
     * Obtient l'utilisateur (étudiant) auquel le document appartient.
     *
     * C'est la relation inverse de la relation "documents()" dans le modèle User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}