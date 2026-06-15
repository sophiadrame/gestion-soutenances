<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soutenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre_memoire',
        'etudiant_nom',
        'etudiant_prenom',
        'filiere',
        'date_soutenance',
        'heure_debut',
        'heure_fin',
        'salle',
        'statut',
    ];

    public function juries()
    {
        return $this->hasMany(Jury::class);
    }
}