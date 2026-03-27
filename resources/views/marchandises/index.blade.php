<x-layouts.app title="Traçabilité">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-extrabold text-gray-800 dark:text-white tracking-tight">Traçabilité des Marchandises</h2>
                
                @if(auth()->user()->role == 'agent')
                    <a href="{{ route('marchandises.create') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-6 rounded-full shadow-lg hover:shadow-blue-500/50 transform hover:scale-105 transition-all duration-300 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Nouvelle Marchandise
                    </a>
                @endif
            </div>

            <!-- MOTEUR DE RECHERCHE ET FILTRES -->
            <form method="GET" action="{{ route('marchandises.index') }}" class="mb-8 bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col md:flex-row gap-4 items-center transition-all">
                
                <div class="flex-1 w-full">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500">🔍</span>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher une référence, un importateur..." class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 dark:text-white outline-none transition-all">
                    </div>
                </div>

                <div class="w-full md:w-64">
                    <select name="statut" class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 dark:text-white outline-none cursor-pointer transition-all">
                        <option value="">Tous les statuts</option>
                        <option value="en attente" {{ request('statut') == 'en attente' ? 'selected' : '' }}>🟡 En attente</option>
                        <option value="en contrôle" {{ request('statut') == 'en contrôle' ? 'selected' : '' }}>🔵 En contrôle</option>
                        <option value="validée" {{ request('statut') == 'validée' ? 'selected' : '' }}>🟢 Validées</option>
                        <option value="bloquée" {{ request('statut') == 'bloquée' ? 'selected' : '' }}>🔴 Bloquées</option>
                    </select>
                </div>

                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit" class="flex-1 md:flex-none bg-gray-800 hover:bg-gray-700 dark:bg-gray-200 dark:hover:bg-white text-white dark:text-gray-900 font-bold py-3 px-6 rounded-xl transition-all shadow">
                        Filtrer
                    </button>
                    
                    @if(request()->has('search') || request()->has('statut'))
                        <a href="{{ route('marchandises.index') }}" class="bg-red-100 hover:bg-red-200 text-red-600 font-bold py-3 px-4 rounded-xl transition-all flex items-center justify-center shadow-sm">
                            ✖
                        </a>
                    @endif
                </div>
            </form>

            <!-- LA GRILLE DE CARTES -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($marchandises as $marchandise)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-2xl border border-gray-100 dark:border-gray-700 p-6 transform hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between">
                        
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Référence</span>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $marchandise->reference }}</h3>
                            </div>
                            
                            <div class="px-3 py-1 rounded-full text-xs font-extrabold uppercase shadow-sm
                                @if($marchandise->statut == 'en attente') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300
                                @elseif($marchandise->statut == 'en contrôle') bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300
                                @elseif($marchandise->statut == 'validée') bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300
                                @else bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300 @endif">
                                {{ $marchandise->statut }}
                            </div>
                        </div>

                        <div class="mb-4 space-y-2">
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                <span class="font-semibold">🏢 Importateur :</span> {{ $marchandise->importateur }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2">
                                {{ $marchandise->description }}
                            </p>
                        </div>

                        <div class="mb-6 p-3 bg-gray-50 dark:bg-gray-900/50 rounded-lg flex items-center justify-between">
                            <span class="text-xs font-bold text-gray-500">Document joint</span>
                            @if($marchandise->documents->count() > 0)
                                <a href="{{ asset('storage/' . $marchandise->documents->first()->chemin_fichier) }}" target="_blank" class="text-xs text-blue-600 dark:text-blue-400 font-bold hover:underline flex items-center gap-1">
                                    📄 Voir PDF
                                </a>
                            @else
                                <span class="text-xs text-red-400 italic">Aucun</span>
                            @endif
                        </div>
                        
                        @if($marchandise->motif)
                            <div class="mb-4 p-3 rounded-lg text-sm font-medium border-l-4 
                                @if($marchandise->statut == 'bloquée') bg-red-50 border-red-500 text-red-800 dark:bg-red-900/30 dark:text-red-300
                                @elseif($marchandise->statut == 'validée') bg-green-50 border-green-500 text-green-800 dark:bg-green-900/30 dark:text-green-300
                                @else bg-orange-50 border-orange-500 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300 @endif">
                                <span class="font-bold flex items-center gap-1 mb-1">
                                    💬 Note du contrôleur :
                                </span>
                                {{ $marchandise->motif }}
                            </div>
                        @endif

                        <div class="mt-auto border-t border-gray-100 dark:border-gray-700 pt-4 flex justify-end">
                            @if(auth()->user()->role == 'agent' && $marchandise->statut == 'en attente')
                                <a href="{{ route('marchandises.edit', $marchandise->id) }}" class="text-blue-600 font-bold hover:bg-blue-50 dark:hover:bg-gray-700 px-4 py-2 rounded-lg transition-colors">Modifier</a>
                            @endif

                            @if(auth()->user()->role == 'controleur')
                                <a href="{{ route('marchandises.controle', $marchandise->id) }}" class="w-full text-center bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 rounded-xl shadow transition-colors">🔍 Contrôler ce dossier</a>
                            @endif

                            @if(auth()->user()->role == 'admin')
                                <a href="{{ route('marchandises.controle', $marchandise->id) }}" class="text-purple-600 font-bold hover:bg-purple-50 dark:hover:bg-gray-700 px-4 py-2 rounded-lg transition-colors">Voir historique &rarr;</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            @if($marchandises->isEmpty())
                <div class="text-center py-20 bg-white dark:bg-gray-800 rounded-2xl border border-dashed border-gray-300 dark:border-gray-700 mt-6">
                    <span class="text-4xl">📭</span>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Aucune marchandise trouvée</h3>
                    <p class="mt-1 text-gray-500 dark:text-gray-400">Commencez par enregistrer une nouvelle marchandise dans le système.</p>
                </div>
            @endif

            <!-- LA PAGINATION EST MAINTENANT ICI (À l'intérieur du conteneur principal) -->
            <div class="mt-8">
                {{ $marchandises->links() }}
            </div>

        </div>
    </div>
</x-layouts.app>