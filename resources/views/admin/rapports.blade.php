<x-layouts.app title="Rapports Système">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- EN-TÊTE ÉPURÉ -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 border-b border-gray-200 dark:border-zinc-800 pb-6">
                <div class="flex items-center gap-4">
                    <!-- Nouvel icône de rapport -->
                    <div class="bg-blue-100 dark:bg-blue-500/10 p-3 rounded-2xl shadow-sm border border-blue-200 dark:border-blue-500/20">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-blue-500 dark:text-blue-400/80 uppercase tracking-widest">Audit & Historique</p>
                        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">Rapport Global</h2>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <!-- LE BOUTON EXCEL -->
                    <a href="{{ route('admin.export.excel') }}" class="flex items-center gap-2 bg-[#107C41] hover:bg-[#185c37] text-white font-extrabold py-2.5 px-6 rounded-xl shadow-lg hover:shadow-green-500/30 transform hover:-translate-y-1 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Exporter (Excel)
                    </a>

                    <!-- BOUTON RETOUR -->
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold text-gray-700 bg-gray-100 hover:bg-gray-200 dark:text-zinc-300 dark:bg-zinc-800 dark:hover:bg-zinc-700 transition-colors shadow-sm">
                        &larr; Retour
                    </a>
                </div>
            </div>

            <!-- LE TABLEAU MODERNE -->
            <div class="bg-white dark:bg-zinc-900 rounded-3xl shadow-sm border border-gray-200 dark:border-zinc-800 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-zinc-800/50 border-b border-gray-200 dark:border-zinc-800">
                                <th class="py-4 px-6 text-xs font-extrabold text-gray-500 dark:text-zinc-400 uppercase tracking-widest">Date & Heure</th>
                                <th class="py-4 px-6 text-xs font-extrabold text-gray-500 dark:text-zinc-400 uppercase tracking-widest">Marchandise (Réf)</th>
                                <th class="py-4 px-6 text-xs font-extrabold text-gray-500 dark:text-zinc-400 uppercase tracking-widest">Utilisateur</th>
                                <th class="py-4 px-6 text-xs font-extrabold text-gray-500 dark:text-zinc-400 uppercase tracking-widest">Action réalisée</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-zinc-800">
                            @forelse($historiques as $historique)
                                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/30 transition-colors">
                                    
                                    <!-- Date -->
                                    <td class="py-4 px-6 text-sm font-extrabold text-gray-600 dark:text-zinc-300 whitespace-nowrap">
                                        {{ $historique->created_at->format('d/m/Y - H:i:s') }}
                                    </td>
                                    
                                    <!-- Référence -->
                                    <td class="py-4 px-6">
                                        <a href="{{ route('marchandises.controle', $historique->marchandise->id) }}" class="inline-flex items-center gap-2 bg-blue-50 hover:bg-blue-100 text-blue-700 dark:bg-blue-500/10 dark:hover:bg-blue-500/20 dark:text-blue-400 font-bold py-1.5 px-3 rounded-lg transition-colors text-sm border border-blue-200 dark:border-blue-500/20">
                                            {{ $historique->marchandise->reference }}
                                        </a>
                                    </td>
                                    
                                    <!-- Utilisateur -->
                                    <td class="py-4 px-6">
                                        <span class="block text-sm font-bold text-gray-900 dark:text-zinc-100">{{ $historique->user->name }}</span>
                                        <span class="block text-xs font-medium text-gray-500 dark:text-zinc-500 uppercase mt-0.5">{{ $historique->user->role }}</span>
                                    </td>
                                    
                                    <!-- Action (Amélioration de la lisibilité) -->
                                    <td class="py-4 px-6 text-sm font-medium text-gray-700 dark:text-zinc-300 leading-relaxed max-w-md">
                                        @if(str_contains($historique->action, 'Changement de statut'))
                                            <!-- Mise en valeur propre des statuts entre crochets -->
                                            {!! preg_replace('/\[(.*?)\]/', '<strong class="inline-block px-2 py-0.5 mx-0.5 rounded text-xs font-extrabold bg-zinc-200 dark:bg-zinc-700 text-gray-900 dark:text-white tracking-widest">$1</strong>', $historique->action) !!}
                                        @else
                                            <span class="flex items-center gap-2">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                                {{ $historique->action }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-16 text-center">
                                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-zinc-800 mb-4">
                                            <svg class="w-8 h-8 text-gray-400 dark:text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">Aucun historique</h3>
                                        <p class="text-gray-500 dark:text-zinc-400">Le registre des actions est actuellement vide.</p>
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