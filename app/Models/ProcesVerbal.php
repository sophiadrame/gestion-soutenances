<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcesVerbal extends Model
{
    use HasFactory;

    protected $fillable = [
        'soutenance_id',
        'note',
        'mention',
        'appreciation',
        'decision',
        'date_pv',
    ];

    public function soutenance()
    {
        return $this->belongsTo(Soutenance::class);
    }
}