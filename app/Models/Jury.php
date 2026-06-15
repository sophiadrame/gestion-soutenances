<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jury extends Model
{
    use HasFactory;

    protected $fillable = [
        'soutenance_id',
        'nom',
        'prenom',
        'email',
        'telephone',
        'role',
        'grade',
    ];

    public function soutenance()
    {
        return $this->belongsTo(Soutenance::class);
    }
}