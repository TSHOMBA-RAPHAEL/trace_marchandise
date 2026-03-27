<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marchandise extends Model
{
    use HasFactory;

// On autorise l'enregistrement de ces champs
    protected $fillable = [
        'reference',
        'description',
        'importateur',
        'statut',
        'motif',
    ];
    
 // On dit à Laravel : "Une marchandise possède plusieurs documents"
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    //Une marchandise possède plusieurs historiques
    public function historiques()
    {
        return $this->hasMany(Historique::class);
    }
}