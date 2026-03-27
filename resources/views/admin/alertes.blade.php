<x-layouts.app title="Alertes & Anomalies">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- EN-TÊTE ÉPURÉ -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 border-b border-gray-200 dark:border-zinc-800 pb-6">
                <div class="flex items-center gap-4">
                    <div class="bg-red-100 dark:bg-red-500/10 p-3 rounded-2xl shadow-sm border border-red-200 dark:border-red-500/20">
                        <svg class="w-8 h-8 text-red-600 dark:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-red-500 dark:text-red-400/80 uppercase tracking-widest">Surveillance Douanière</p>
                        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">Marchandises Bloquées</h2>
                    </div>
                </div>
                
                <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold text-gray-700 bg-gray-100 hover:bg-gray-200 dark:text-zinc-300 dark:bg-zinc-800 dark:hover:bg-zinc-700 transition-colors shadow-sm">
                    &larr; Retour
                </a>
            </div>

            <!-- LE TABLEAU MODERNE (Même style que Utilisateurs) -->
            <div class="bg-white dark:bg-zinc-900 rounded-3xl shadow-sm border border-gray-200 dark:border-zinc-800 overflow-hidden relative">
                
                <!-- Ligne de décoration rouge en haut du tableau -->
                <div class="absolute top-0 left-0 w-full h-1 bg-red-500"></div>

                <div class="overflow-x-auto mt-1">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-zinc-800/50 border-b border-gray-200 dark:border-zinc-800">
                                <th class="py-4 px-6 text-xs font-extrabold text-gray-500 dark:text-zinc-400 uppercase tracking-widest">Référence</th>
                                <th class="py-4 px-6 text-xs font-extrabold text-gray-500 dark:text-zinc-400 uppercase tracking-widest">Importateur</th>
                                <th class="py-4 px-6 text-xs font-extrabold text-gray-500 dark:text-zinc-400 uppercase tracking-widest">Date de blocage</th>
                                <th class="py-4 px-6 text-xs font-extrabold text-gray-500 dark:text-zinc-400 uppercase tracking-widest text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-zinc-800">
                            @forelse($marchandisesBloquees as $marchandise)
                                <tr class="hover:bg-red-50/50 dark:hover:bg-zinc-800/30 transition-colors group">
                                    
                                    <!-- Référence avec icône -->
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-2 h-2 rounded-full bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.8)]"></div>
                                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $marchandise->reference }}</span>
                                        </div>
                                    </td>

                                    <!-- Importateur -->
                                    <td class="py-4 px-6 text-sm font-medium text-gray-600 dark:text-zinc-300">
                                        {{ $marchandise->importateur }}
                                    </td>

                                    <!-- Date de blocage (Rouge) -->
                                    <td class="py-4 px-6 text-sm font-bold text-red-600 dark:text-red-400">
                                        {{ $marchandise->updated_at->format('d/m/Y à H:i') }}
                                    </td>
                                    
                                    <!-- Bouton "Voir le dossier" -->
                                    <td class="py-4 px-6 text-center">
                                        <a href="{{ route('marchandises.controle', $marchandise->id) }}" class="inline-flex items-center gap-2 bg-red-50 hover:bg-red-100 text-red-700 dark:bg-red-500/10 dark:hover:bg-red-500/20 dark:text-red-400 font-bold py-2 px-4 rounded-xl transition-all text-xs border border-red-200 dark:border-red-500/20 transform group-hover:scale-105">
                                            Ouvrir le dossier <span class="text-lg leading-none">&rarr;</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-16 text-center">
                                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 dark:bg-green-500/10 mb-4">
                                            <svg class="w-8 h-8 text-green-600 dark:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">Aucune alerte active</h3>
                                        <p class="text-gray-500 dark:text-zinc-400">Excellente nouvelle, aucune marchandise n'est actuellement bloquée dans le système.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-layouts.app>