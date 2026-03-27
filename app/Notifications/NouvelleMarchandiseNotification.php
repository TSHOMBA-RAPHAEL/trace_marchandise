<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NouvelleMarchandiseNotification extends Notification
{
    use Queueable;

    protected $marchandise;
    protected $agent;

    public function __construct($marchandise, $agent)
    {
        $this->marchandise = $marchandise;
        $this->agent = $agent;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'marchandise_id' => $this->marchandise->id,
            'reference' => $this->marchandise->reference,
            'statut' => 'nouvelle', // On met "nouvelle" pour afficher l'icône de carton 📦
            'message' => "L'agent " . $this->agent->name . " vient d'enregistrer une nouvelle marchandise."
        ];
    }
}