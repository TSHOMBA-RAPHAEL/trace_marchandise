<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StatutModifieNotification extends Notification
{
    use Queueable;

    protected $marchandise;
    protected $nouveauStatut;
    protected $controleur;

    public function __construct($marchandise, $nouveauStatut, $controleur)
    {
        $this->marchandise = $marchandise;
        $this->nouveauStatut = $nouveauStatut;
        $this->controleur = $controleur;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $message = "Le contrôleur " . $this->controleur->name . " a passé cette marchandise en : " . strtoupper($this->nouveauStatut) . ".";
        
        // Si le contrôleur a écrit un motif, on l'ajoute à la notification !
        if ($this->marchandise->motif) {
            $message .= " Motif : " . $this->marchandise->motif;
        }

        return [
            'marchandise_id' => $this->marchandise->id,
            'reference' => $this->marchandise->reference,
            'statut' => $this->nouveauStatut,
            'message' => $message
        ];
    }
}