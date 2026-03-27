<x-layouts.app title="Tableau de Bord Agent">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- BANNIÈRE DE BIENVENUE ANIMÉE -->
            <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl shadow-lg border border-blue-500 text-white p-8 sm:p-10">
                <div class="relative z-10">
                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-2">
                        👋 Bienvenue, {{ auth()->user()->name }}
                    </h1>
                    <p class="text-blue-100 text-lg max-w-2xl">
                        Espace d'enregistrement douanier. Saisissez les nouvelles marchandises et assurez le suivi de vos dossiers avant le contrôle.
                    </p>
                </div>
                <!-- Formes décoratives en arrière-plan -->
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 right-20 w-24 h-24 bg-blue-300 opacity-20 rounded-full blur-xl"></div>
                <span class="absolute right-10 top-10 text-8xl opacity-20 transform rotate-12">📦</span>
            </div>

            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 px-2">Vos actions rapides</h2>

            <!-- CARTES D'ACTION MODERNES -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Carte : Nouvelle Arrivée -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-sm hover:shadow-2xl border border-gray-100 dark:border-gray-700 transform hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-blue-500 group-hover:bg-blue-600 transition-colors"></div>
                    
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Nouvelle Arrivée</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-6">Saisissez les informations d'une marchandise entrant en entrepôt et joignez les documents requis.</p>
                        </div>
                    </div>
                    
                    <a href="{{ route('marchandises.create') }}" class="inline-flex items-center justify-center w-full bg-blue-50 hover:bg-blue-600 text-blue-700 hover:text-white dark:bg-gray-700 dark:hover:bg-blue-600 dark:text-blue-400 dark:hover:text-white font-bold py-3 px-4 rounded-xl transition-colors">
                        Commencer l'enregistrement &rarr;
                    </a>
                </div>

                <!-- Carte : Suivi des enregistrements -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-sm hover:shadow-2xl border border-gray-100 dark:border-gray-700 transform hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-green-500 group-hover:bg-green-600 transition-colors"></div>
                    
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Suivi des Dossiers</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-6">Consultez la liste de toutes les marchandises, vérifiez leurs statuts ou modifiez celles en attente.</p>
                        </div>
                    </div>
                    
                    <a href="{{ route('marchandises.index') }}" class="inline-flex items-center justify-center w-full bg-green-50 hover:bg-green-600 text-green-700 hover:text-white dark:bg-gray-700 dark:hover:bg-green-600 dark:text-green-400 dark:hover:text-white font-bold py-3 px-4 rounded-xl transition-colors">
                        Ouvrir le registre &rarr;
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>