<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marchandise;
use App\Models\Document;
use App\Models\Historique;
use App\Models\User; // NOUVEAU : Pour chercher les utilisateurs
use Illuminate\Support\Facades\Notification; // NOUVEAU : Pour envoyer à un groupe
use App\Notifications\StatutModifieNotification;
use App\Notifications\NouvelleMarchandiseNotification; // NOUVEAU

class MarchandiseController extends Controller
{
    public function index(Request $request)
    {
        $query = Marchandise::with('documents')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('reference', 'like', "%{$search}%")
                  ->orWhere('importateur', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $marchandises = $query->paginate(12);
        return view('marchandises.index', compact('marchandises'));
    }

    public function create()
    {
        return view('marchandises.create');
    }

    // 1. QUAND UN AGENT ENREGISTRE UNE MARCHANDISE
    public function store(Request $request)
    {
        $request->validate([
            'reference' => 'required|unique:marchandises',
            'description' => 'required|string',
            'importateur' => 'required|string|max:255',
            'document_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $marchandise = Marchandise::create([
            'reference' => $request->reference,
            'description' => $request->description,
            'importateur' => $request->importateur,
            'statut' => 'en attente',
        ]);

        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $nomFichier = time() . '_' . $file->getClientOriginalName();
            $chemin = $file->storeAs('documents', $nomFichier, 'public');

            Document::create([
                'marchandise_id' => $marchandise->id,
                'nom_fichier' => $file->getClientOriginalName(),
                'chemin_fichier' => $chemin,
            ]);
        }

        Historique::create([
            'marchandise_id' => $marchandise->id,
            'user_id' => auth()->id(),
            'action' => "Enregistrement initial de la marchandise."
        ]);

        // --- ENVOI DE NOTIFICATIONS À TOUS LES ADMINS ET CONTRÔLEURS ---
        $adminsEtControleurs = User::whereIn('role', ['admin', 'controleur'])->get();
        Notification::send($adminsEtControleurs, new NouvelleMarchandiseNotification($marchandise, auth()->user()));

        return redirect()->route('marchandises.index')->with('success', 'Marchandise enregistrée avec succès !');
    }

    public function edit(Marchandise $marchandise)
    {
        if ($marchandise->statut !== 'en attente' && auth()->user()->role === 'agent') {
            return redirect()->route('marchandises.index')->with('error', 'Vous ne pouvez plus modifier cette marchandise.');
        }
        return view('marchandises.edit', compact('marchandise'));
    }

    public function update(Request $request, Marchandise $marchandise)
    {
        $request->validate([
            'reference' => 'required|unique:marchandises,reference,' . $marchandise->id,
            'description' => 'required|string',
            'importateur' => 'required|string|max:255',
        ]);

        $marchandise->update([
            'reference' => $request->reference,
            'description' => $request->description,
            'importateur' => $request->importateur,
        ]);

        Historique::create([
            'marchandise_id' => $marchandise->id,
            'user_id' => auth()->id(),
            'action' => "Mise à jour des informations par l'agent."
        ]);

        return redirect()->route('marchandises.index')->with('success', 'Les informations ont été mises à jour !');
    }

    public function showControle(Marchandise $marchandise)
    {
        if (auth()->user()->role === 'agent') abort(403, 'Accès refusé.');
        $historiques = $marchandise->historiques()->with('user')->orderBy('created_at', 'desc')->get();
        return view('marchandises.controle', compact('marchandise', 'historiques'));
    }

    // 2. QUAND UN CONTRÔLEUR CHANGE LE STATUT
    public function updateStatut(Request $request, Marchandise $marchandise)
    {
        if (auth()->user()->role !== 'controleur') abort(403, 'Accès refusé.');

        $request->validate([
            'statut' => 'required|in:en attente,en contrôle,validée,bloquée',
            'motif' => 'nullable|string|max:1000'
        ]);

        $ancienStatut = $marchandise->statut;
        $nouveauStatut = $request->statut;

        $marchandise->update([
            'statut' => $nouveauStatut,
            'motif' => $request->motif
        ]);

        $texteHistorique = "Changement de statut : de [" . strtoupper($ancienStatut) . "] vers [" . strtoupper($nouveauStatut) . "].";
        if ($request->motif) {
            $texteHistorique .= " Motif : " . $request->motif;
        }

        Historique::create([
            'marchandise_id' => $marchandise->id,
            'user_id' => auth()->id(),
            'action' => $texteHistorique
        ]);

        // --- ENVOI DE NOTIFICATIONS ---
        // 1. On récupère tous les admins et contrôleurs
        $utilisateursANotifier = User::whereIn('role', ['admin', 'controleur'])->get();
        
        // 2. On cherche l'agent qui a créé la marchandise
        $enregistrement = Historique::where('marchandise_id', $marchandise->id)
                                    ->where('action', 'like', '%Enregistrement initial%')
                                    ->first();
                                    
        // 3. On ajoute cet agent à la liste des gens à notifier (s'il n'y est pas déjà)
        if ($enregistrement && $enregistrement->user && !in_array($enregistrement->user->role, ['admin', 'controleur'])) {
            $utilisateursANotifier->push($enregistrement->user);
        }

        // 4. On envoie la notification à TOUT CE GROUPE
        Notification::send($utilisateursANotifier, new StatutModifieNotification($marchandise, $nouveauStatut, auth()->user()));

        return redirect()->route('marchandises.index')->with('success', 'Le statut a été mis à jour avec succès.');
    }
}