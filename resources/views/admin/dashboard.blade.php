<x-layouts.app title="Espace Administration">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-medium text-lg">
                    👋 Bienvenue, Administrateur {{ auth()->user()->name }} !
                    <p class="text-sm text-gray-500 mt-1">Vous avez une vue globale sur le système de traçabilité des marchandises.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white p-6 rounded-lg shadow border-t-4 border-purple-500">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Comptes & Rôles</h3>
                    <p class="text-sm text-gray-600 mb-4 h-10">Créer des agents, des contrôleurs et gérer leurs accès.</p>
                    <a href="{{ route('admin.users.index') }}" class="block text-center bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded transition">
                        Gérer les utilisateurs
                    </a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow border-t-4 border-blue-500">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Rapports du Système</h3>
                    <p class="text-sm text-gray-600 mb-4 h-10">Consulter l'historique global de traçabilité des marchandises.</p>
                    <a href="{{ route('admin.rapports') }}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                        Consulter les rapports
                    </a>
                </div>

                <!-- Bloc 3 : Notifications & Alertes -->
                <div class="bg-white p-6 rounded-lg shadow border-t-4 border-red-500 relative dark:bg-gray-800">
                    
                    <!-- Pastille rouge dynamique -->
                    @if($alertesCount > 0)
                        <span class="absolute top-4 right-4 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow animate-pulse">
                            {{ $alertesCount }} alerte(s)
                        </span>
                    @else
                        <span class="absolute top-4 right-4 bg-gray-400 text-white text-xs font-bold px-3 py-1 rounded-full">
                            0 alerte
                        </span>
                    @endif
                    
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2">Alertes Marchandises</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 h-10">Voir les marchandises bloquées suite à un contrôle non conforme.</p>
                    
                    <a href="{{ route('admin.alertes') }}" class="block text-center bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition">
                        Voir les alertes
                    </a>
                </div>

            </div>
        </div>
    </div>
    <!-- NOUVEAU BLOC GRAPHIQUE -->
            <div class="mt-8 bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">📊 Statistiques de l'Entrepôt</h3>
                
                <div class="flex flex-col md:flex-row items-center justify-around">
                    <!-- Conteneur du graphique (Canvas) -->
                    <div class="w-full md:w-1/3 relative" style="height: 300px;">
                        <canvas id="statutChart"></canvas>
                    </div>
                    
                    <!-- Légende personnalisée avec chiffres -->
                    <div class="w-full md:w-1/2 mt-8 md:mt-0 space-y-4">
                        <div class="flex justify-between items-center p-4 bg-gray-50 dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-700">
                            <span class="flex items-center gap-2 font-bold text-gray-700 dark:text-gray-300"><span class="w-3 h-3 rounded-full bg-yellow-400"></span> En attente</span>
                            <span class="text-xl font-extrabold">{{ $stats['attente'] }}</span>
                        </div>
                        <div class="flex justify-between items-center p-4 bg-gray-50 dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-700">
                            <span class="flex items-center gap-2 font-bold text-gray-700 dark:text-gray-300"><span class="w-3 h-3 rounded-full bg-blue-500"></span> En contrôle</span>
                            <span class="text-xl font-extrabold">{{ $stats['controle'] }}</span>
                        </div>
                        <div class="flex justify-between items-center p-4 bg-gray-50 dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-700">
                            <span class="flex items-center gap-2 font-bold text-gray-700 dark:text-gray-300"><span class="w-3 h-3 rounded-full bg-green-500"></span> Validées</span>
                            <span class="text-xl font-extrabold">{{ $stats['validee'] }}</span>
                        </div>
                        <div class="flex justify-between items-center p-4 bg-gray-50 dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-700">
                            <span class="flex items-center gap-2 font-bold text-gray-700 dark:text-gray-300"><span class="w-3 h-3 rounded-full bg-red-500"></span> Bloquées</span>
                            <span class="text-xl font-extrabold text-red-600">{{ $stats['bloquee'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chargement de la librairie Chart.js depuis le web -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ctx = document.getElementById('statutChart').getContext('2d');
                    
                    // On récupère les couleurs du thème (Dark mode / Light mode) pour le texte du graphique
                    const isDarkMode = document.documentElement.classList.contains('dark');
                    const textColor = isDarkMode ? '#e5e7eb' : '#374151';

                    new Chart(ctx, {
                        type: 'doughnut', // Type "Camembert troué"
                        data: {
                            labels: ['En attente', 'En contrôle', 'Validées', 'Bloquées'],
                            datasets: [{
                                data: [{{ $stats['attente'] }}, {{ $stats['controle'] }}, {{ $stats['validee'] }}, {{ $stats['bloquee'] }}],
                                backgroundColor: [
                                    '#FBBF24', // Jaune
                                    '#3B82F6', // Bleu
                                    '#10B981', // Vert
                                    '#EF4444'  // Rouge
                                ],
                                borderWidth: 0,
                                hoverOffset: 10
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false // On cache la légende par défaut pour utiliser notre propre légende HTML
                                }
                            },
                            cutout: '70%', // Taille du trou au milieu
                        }
                    });
                });
            </script>
</x-layouts.app>