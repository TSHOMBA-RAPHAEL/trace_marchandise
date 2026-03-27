<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Marchandise;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 1. Afficher la liste
    public function index()
    {
        if (auth()->user()->role !== 'admin') abort(403);
        $users = User::all(); 
        return view('admin.users.index', compact('users'));
    }

    // 2. Afficher le formulaire d'ajout
    public function create()
    {
        if (auth()->user()->role !== 'admin') abort(403);
        return view('admin.users.create');
    }

    // 3. Enregistrer un nouvel utilisateur
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') abort(403);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,agent,controleur'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès !');
    }

    // 4. Afficher le formulaire de MODIFICATION (Pré-rempli)
    public function edit(User $user)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        return view('admin.users.edit', compact('user')); // On envoie les infos de l'utilisateur à la vue
    }

    // 5. Mettre à jour les données dans la base (L'équivalent de UPDATE)
    public function update(Request $request, User $user)
    {
        if (auth()->user()->role !== 'admin') abort(403);

        // Validation (On autorise de garder le même email pour cet utilisateur précis)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,agent,controleur',
            'password' => 'nullable|min:6' // "nullable" = facultatif
        ]);

        // Mise à jour des infos de base
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Si l'admin a tapé un nouveau mot de passe, on le crypte et on le change
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save(); // Sauvegarde dans la base de données

        return redirect()->route('admin.users.index')->with('success', 'Les informations ont été modifiées avec succès !');
    }

    // 6. Supprimer un utilisateur (DELETE)
    public function destroy(User $user)
    {
        if (auth()->user()->role !== 'admin') abort(403);

        // Sécurité : Interdire à l'administrateur de supprimer son propre compte
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'Action refusée : Vous ne pouvez pas supprimer votre propre compte !');
        }

        // Suppression
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Le compte utilisateur a été supprimé définitivement.');
    }
    // 7. Afficher le rapport global pour l'admin
    public function rapports()
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        // On récupère tout l'historique du système
        $historiques = \App\Models\Historique::with(['user', 'marchandise'])->orderBy('created_at', 'desc')->get();
        return view('admin.rapports', compact('historiques'));
    }
    // 8. Afficher les alertes (Marchandises bloquées)
    public function alertes()
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        // On récupère uniquement les marchandises dont le statut est "bloquée"
        $marchandisesBloquees = Marchandise::with('documents')->where('statut', 'bloquée')->orderBy('updated_at', 'desc')->get();
        
        return view('admin.alertes', compact('marchandisesBloquees'));
    }
    // 9. Exporter la liste en fichier Excel (CSV)
    public function exportExcel()
    {
        // Sécurité : Seul l'admin peut télécharger
        if (auth()->user()->role !== 'admin') abort(403);

        $marchandises = \App\Models\Marchandise::orderBy('created_at', 'desc')->get();
        $nomFichier = "rapport_douane_" . date('d-m-Y') . ".csv";

        // On prépare le fichier pour le téléchargement
        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$nomFichier",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // On dessine le tableau
        $colonnes = ['Date', 'Reference', 'Importateur', 'Description', 'Statut Douanier', 'Motif / Remarque'];

        $callback = function() use($marchandises, $colonnes) {
            $file = fopen('php://output', 'w');
            
            // Astuce Pro : On ajoute le BOM UTF-8 pour que Excel lise bien les accents (é, à...)
            fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            
            // On écrit la ligne des titres (On utilise le point-virgule pour Excel en français)
            fputcsv($file, $colonnes, ';');

            // On écrit les données ligne par ligne
            foreach ($marchandises as $m) {
                fputcsv($file, [
                    $m->created_at->format('d/m/Y H:i'),
                    $m->reference,
                    $m->importateur,
                    $m->description,
                    strtoupper($m->statut),
                    $m->motif ?? 'Aucune note'
                ], ';');
            }

            fclose($file);
        };

        // On envoie le fichier directement au navigateur
        return response()->stream($callback, 200, $headers);
    }

    // 10. Afficher les notifications
    public function notifications()
    {
        $notifications = auth()->user()->notifications; // Toutes les notifs
        return view('notifications', compact('notifications'));
    }

    // 11. Marquer tout comme lu
    public function marquerLues()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }
}