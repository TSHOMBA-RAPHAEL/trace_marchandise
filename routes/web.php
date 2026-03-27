<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarchandiseController;
use App\Http\Controllers\UserController;

Route::view('/', 'welcome')->name('home');

Route::get('/dashboard', function (Request $request) {
    $role = $request->user()->role;
    
    if ($role === 'admin') {
        // Calcul des statistiques pour le graphique
        $stats = [
            'attente' => \App\Models\Marchandise::where('statut', 'en attente')->count(),
            'controle' => \App\Models\Marchandise::where('statut', 'en contrôle')->count(),
            'validee' => \App\Models\Marchandise::where('statut', 'validée')->count(),
            'bloquee' => \App\Models\Marchandise::where('statut', 'bloquée')->count(),
        ];
        
        $alertesCount = $stats['bloquee']; // On réutilise le chiffre des bloquées pour l'alerte
        
        return view('admin.dashboard', compact('alertesCount', 'stats'));
    } 
    elseif ($role === 'controleur') {
        return view('controleur.dashboard');
    } 
    else {
        return view('agent.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    
    // --- ROUTES MARCHANDISES (Agent et Contrôleur) ---
    Route::get('/marchandises', [MarchandiseController::class, 'index'])->name('marchandises.index');
    Route::get('/marchandises/ajouter', [MarchandiseController::class, 'create'])->name('marchandises.create');
    Route::post('/marchandises/ajouter', [MarchandiseController::class, 'store'])->name('marchandises.store'); 
    Route::get('/marchandises/{marchandise}/modifier', [MarchandiseController::class, 'edit'])->name('marchandises.edit');
    Route::put('/marchandises/{marchandise}/modifier', [MarchandiseController::class, 'update'])->name('marchandises.update');
    Route::get('/marchandises/{marchandise}/controle', [MarchandiseController::class, 'showControle'])->name('marchandises.controle');
    Route::put('/marchandises/{marchandise}/statut', [MarchandiseController::class, 'updateStatut'])->name('marchandises.statut');
    // --- ROUTES NOTIFICATIONS ---
    Route::get('/notifications', [UserController::class, 'notifications'])->name('notifications.index');
    Route::post('/notifications/marquer-lues', [UserController::class, 'marquerLues'])->name('notifications.read');

    // --- ROUTES ADMINISTRATEUR ---
    Route::get('/admin/utilisateurs', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/utilisateurs/ajouter', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/utilisateurs/ajouter', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/utilisateurs/{user}/modifier', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/utilisateurs/{user}/modifier', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/utilisateurs/{user}/supprimer', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/rapports', [UserController::class, 'rapports'])->name('admin.rapports');
    Route::get('/admin/alertes', [UserController::class, 'alertes'])->name('admin.alertes');
    // ROUTE POUR TÉLÉCHARGER LE FICHIER EXCEL ---
    Route::get('/admin/exporter-marchandises', [UserController::class, 'exportExcel'])->name('admin.export.excel');

});

require __DIR__.'/settings.php';