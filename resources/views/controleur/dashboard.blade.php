<x-layouts.app title="Tableau de Bord Contrôleur">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- BANNIÈRE DE BIENVENUE ANIMÉE (Thème Orange/Gris) -->
            <div class="relative overflow-hidden bg-gradient-to-r from-gray-800 to-gray-900 dark:from-black dark:to-gray-900 rounded-3xl shadow-lg border border-gray-700 text-white p-8 sm:p-10">
                <div class="relative z-10">
                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-2">
                        🛡️ Espace Contrôle, {{ auth()->user()->name }}
                    </h1>
                    <p class="text-gray-300 text-lg max-w-2xl">
                        Vérifiez la conformité des marchandises enregistrées et prenez les décisions douanières de validation ou de blocage.
                    </p>
                </div>
                <div class="absolute bottom-0 right-20 w-32 h-32 bg-orange-500 opacity-20 rounded-full blur-2xl"></div>
                <span class="absolute right-10 top-10 text-8xl opacity-10 transform -rotate-12">⚖️</span>
            </div>

            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 px-2">Espace de travail</h2>

            <!-- CARTES D'ACTION MODERNES -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Carte : File d'attente -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-sm hover:shadow-2xl border border-gray-100 dark:border-gray-700 transform hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-orange-500 group-hover:bg-orange-600 transition-colors"></div>
                    
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-orange-100 dark:bg-orange-900/50 text-orange-600 dark:text-orange-400 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Dossiers à contrôler</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-6">Accédez à la liste des marchandises nécessitant une inspection douanière immédiate.</p>
                        </div>
                    </div>
                    
                    <a href="{{ route('marchandises.index') }}" class="inline-flex items-center justify-center w-full bg-orange-50 hover:bg-orange-600 text-orange-700 hover:text-white dark:bg-gray-700 dark:hover:bg-orange-600 dark:text-orange-400 dark:hover:text-white font-bold py-3 px-4 rounded-xl transition-colors">
                        Lancer les contrôles &rarr;
                    </a>
                </div>

                <!-- Carte : Archives -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-sm hover:shadow-2xl border border-gray-100 dark:border-gray-700 transform hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-gray-500 group-hover:bg-gray-600 transition-colors"></div>
                    
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Archives et Historique</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-6">Consultez les marchandises que vous avez déjà validées ou bloquées par le passé.</p>
                        </div>
                    </div>
                    
                    <a href="{{ route('marchandises.index') }}" class="inline-flex items-center justify-center w-full bg-gray-50 hover:bg-gray-600 text-gray-700 hover:text-white dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-300 dark:hover:text-white font-bold py-3 px-4 rounded-xl transition-colors">
                        Consulter les archives &rarr;
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>