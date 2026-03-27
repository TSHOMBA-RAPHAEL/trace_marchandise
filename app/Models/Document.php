<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'marchandise_id',
        'nom_fichier',
        'chemin_fichier',
    ];

    // On dit à Laravel : "Un document appartient à une marchandise"
    public function marchandise()
    {
        return $this->belongsTo(Marchandise::class);
    }
}