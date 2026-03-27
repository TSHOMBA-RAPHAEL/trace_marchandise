<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasFactory;

    protected $fillable = [
        'marchandise_id',
        'user_id',
        'action',
    ];

    // L'historique appartient à un utilisateur (Celui qui a cliqué)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // L'historique appartient à une marchandise
    public function marchandise()
    {
        return $this->belongsTo(Marchandise::class);
    }
}