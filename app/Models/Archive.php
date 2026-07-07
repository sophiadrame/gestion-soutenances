<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'soutenance_id',
        'nom_fichier',
        'chemin_fichier',
        'type_document',
        'annee_universitaire',
        'description',
    ];

    public function soutenance()
    {
        return $this->belongsTo(Soutenance::class);
    }
}