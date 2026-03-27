<x-layouts.app title="Détails & Traçabilité">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- EN-TÊTE DE LA PAGE -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white flex items-center gap-3">
                        <span class="bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 p-2 rounded-xl shadow-sm">📦</span>
                        Dossier : {{ $marchandise->reference }}
                    </h2>
                </div>
                <a href="{{ route('marchandises.index') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-bold border border-gray-300 dark:border-gray-600 px-5 py-2.5 rounded-xl transition-colors bg-white dark:bg-gray-800 shadow-sm">
                    &larr; Retour au registre
                </a>
            </div>

            <!-- GRILLE PRINCIPALE -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- COLONNE GAUCHE : Fiche technique -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- CARTE : Informations de base -->
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="p-8">
                            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-6 mb-6">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Informations Générales</h3>
                                
                                <div class="px-4 py-1.5 rounded-full text-sm font-extrabold uppercase shadow-sm
                                    @if($marchandise->statut == 'en attente') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                    @elseif($marchandise->statut == 'en contrôle') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                    @elseif($marchandise->statut == 'validée') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                    @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 @endif">
                                    Statut : {{ $marchandise->statut }}
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                                <div>
                                    <span class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Importateur / Propriétaire</span>
                                    <span class="block text-gray-900 dark:text-white font-extrabold text-lg">{{ $marchandise->importateur }}</span>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Date d'enregistrement</span>
                                    <span class="block text-gray-900 dark:text-white font-extrabold text-lg">{{ $marchandise->created_at->format('d/m/Y à H:i') }}</span>
                                </div>
                            </div>

                            <div>
                                <span class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Description détaillée</span>
                                <!-- CORRECTION CSS ICI : Fond gris foncé et texte clair -->
                                <div class="bg-gray-50 dark:bg-gray-700 p-5 rounded-xl border border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-100 font-medium">
                                    {{ $marchandise->description }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CARTE : Documents & Pièces jointes -->
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-200 dark:border-gray-700 p-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 border-b border-gray-200 dark:border-gray-700 pb-4">Pièces Jointes</h3>
                        
                        @if($marchandise->documents->count() > 0)
                            <a href="{{ asset('storage/' . $marchandise->documents->first()->chemin_fichier) }}" target="_blank" class="group flex items-center justify-between p-4 bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 rounded-xl hover:bg-blue-100 dark:hover:bg-blue-800 transition-all shadow-sm">
                                <div class="flex items-center gap-4">
                                    <span class="text-3xl">📄</span>
                                    <div>
                                        <p class="font-bold text-blue-900 dark:text-blue-100 text-lg">{{ $marchandise->documents->first()->nom_fichier }}</p>
                                        <p class="text-sm font-medium text-blue-600 dark:text-blue-300 mt-1">Cliquez pour ouvrir dans un nouvel onglet</p>
                                    </div>
                                </div>
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-300 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        @else
                            <div class="flex items-center gap-3 p-5 bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-xl border border-gray-200 dark:border-gray-600">
                                <span class="text-2xl">🚫</span>
                                <p class="font-bold">Aucun document n'a été fourni par l'agent.</p>
                            </div>
                        @endif
                    </div>

                    <!-- CARTE : FORMULAIRE DE DÉCISION (Visible uniquement par le contrôleur) -->
                    @if(auth()->user()->role === 'controleur')
                    <div class="bg-gradient-to-br from-orange-50 to-white dark:from-gray-800 dark:to-gray-800 rounded-3xl shadow-lg border-2 border-orange-300 dark:border-orange-500 p-8">
                        <h3 class="text-xl font-extrabold text-orange-900 dark:text-orange-400 mb-6 flex items-center gap-2">
                            <span>⚖️</span> Décision Douanière
                        </h3>
                        
                        <form action="{{ route('marchandises.statut', $marchandise->id) }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')
                            
                            <div>
                                <label class="block text-gray-800 dark:text-gray-200 font-bold mb-2">Modifier le statut :</label>
                                <select name="statut" class="w-full px-4 py-3 bg-white dark:bg-gray-900 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-500 outline-none shadow-sm font-bold" required>
                                    <option value="en attente" {{ $marchandise->statut == 'en attente' ? 'selected' : '' }}>🟡 Remettre en attente</option>
                                    <option value="en contrôle" {{ $marchandise->statut == 'en contrôle' ? 'selected' : '' }}>🔵 Mettre en contrôle (Inspection)</option>
                                    <option value="validée" {{ $marchandise->statut == 'validée' ? 'selected' : '' }}>🟢 VALIDÉE (Prêt pour dédouanement)</option>
                                    <option value="bloquée" {{ $marchandise->statut == 'bloquée' ? 'selected' : '' }}>🔴 BLOQUÉE (Non conforme)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-gray-800 dark:text-gray-200 font-bold mb-2">Motif / Remarque :</label>
                                <textarea name="motif" rows="3" class="w-full px-4 py-3 bg-white dark:bg-gray-900 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-500 outline-none shadow-sm" placeholder="Expliquez votre décision (Facultatif mais recommandé)...">{{ $marchandise->motif }}</textarea>
                            </div>
                            
                            <button type="submit" class="w-full bg-orange-600 hover:bg-orange-500 text-white font-extrabold py-4 px-6 rounded-xl shadow-lg hover:shadow-orange-500/40 transform hover:-translate-y-1 transition-all">
                                Valider et Enregistrer la décision
                            </button>
                        </form>
                    </div>
                    @endif
                </div>

                <!-- COLONNE DROITE : Historique (Timeline) -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-200 dark:border-gray-700 p-8 sticky top-6">
                        <h3 class="text-xl font-extrabold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-4 mb-8 flex items-center gap-2">
                            <span>⏱️</span> Historique
                        </h3>
                        
                        <div class="relative border-l-2 border-blue-500 dark:border-blue-500 ml-3 space-y-8 pb-4">
                            
                            @foreach($historiques as $historique)
                                <div class="relative pl-6">
                                    <!-- Le point bleu -->
                                    <div class="absolute -left-[9px] top-1.5 h-4 w-4 rounded-full bg-blue-500 border-4 border-white dark:border-gray-800 shadow-sm"></div>
                                    
                                    <!-- CORRECTION CSS ICI : Fond sombre solide (gray-700) et texte très clair (gray-100) -->
                                    <div class="bg-gray-50 dark:bg-gray-700 p-5 rounded-2xl border border-gray-200 dark:border-gray-600 shadow-sm transition-colors hover:border-blue-300 dark:hover:border-blue-400">
                                        
                                        <div class="text-xs font-extrabold text-blue-600 dark:text-blue-300 tracking-wider uppercase mb-2">
                                            {{ $historique->created_at->format('d/m/Y - H:i') }}
                                        </div>
                                        
                                        <div class="font-extrabold text-gray-900 dark:text-white text-base mb-2">
                                            {{ $historique->user->name }} 
                                            <span class="text-gray-500 dark:text-gray-300 font-medium text-sm">({{ ucfirst($historique->user->role) }})</span>
                                        </div>
                                        
                                        <!-- Le texte de l'action -->
                                        <div class="text-sm text-gray-800 dark:text-gray-100 font-medium leading-relaxed">
                                            @if(str_contains($historique->action, 'Changement de statut'))
                                                {!! preg_replace('/\[(.*?)\]/', '<strong class="text-white dark:text-white bg-gray-800 dark:bg-gray-900 px-2 py-1 rounded shadow-sm mx-1">$1</strong>', $historique->action) !!}
                                            @else
                                                {{ $historique->action }}
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>