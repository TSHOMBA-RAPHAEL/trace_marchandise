<x-layouts.app title="Gestion des Utilisateurs">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- ALERTES DE SUCCÈS OU D'ERREUR -->
            @if(session('success'))
                <div class="bg-green-50 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20 text-green-700 dark:text-green-400 p-4 mb-6 rounded-2xl shadow-sm flex items-center gap-3">
                    <span class="text-xl">✅</span>
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-700 dark:text-red-400 p-4 mb-6 rounded-2xl shadow-sm flex items-center gap-3">
                    <span class="text-xl">❌</span>
                    <p class="font-bold">{{ session('error') }}</p>
                </div>
            @endif

            <!-- EN-TÊTE ÉPURÉ -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 border-b border-gray-200 dark:border-zinc-800 pb-6">
                <div class="flex items-center gap-4">
                    <div class="bg-purple-100 dark:bg-purple-900/30 p-3 rounded-2xl shadow-sm">
                        <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-500 dark:text-zinc-400 uppercase tracking-widest">Administration</p>
                        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">Comptes Utilisateurs</h2>
                    </div>
                </div>
                
                <a href="{{ route('admin.users.create') }}" class="flex items-center gap-2 bg-purple-600 hover:bg-purple-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-purple-500/30 transform hover:-translate-y-1 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Créer un compte
                </a>
            </div>

            <!-- LE TABLEAU MODERNE -->
            <div class="bg-white dark:bg-zinc-900 rounded-3xl shadow-sm border border-gray-200 dark:border-zinc-800 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-zinc-800/50 border-b border-gray-200 dark:border-zinc-800">
                                <th class="py-4 px-6 text-xs font-extrabold text-gray-500 dark:text-zinc-400 uppercase tracking-widest">Nom complet</th>
                                <th class="py-4 px-6 text-xs font-extrabold text-gray-500 dark:text-zinc-400 uppercase tracking-widest">Email</th>
                                <th class="py-4 px-6 text-xs font-extrabold text-gray-500 dark:text-zinc-400 uppercase tracking-widest">Rôle système</th>
                                <th class="py-4 px-6 text-xs font-extrabold text-gray-500 dark:text-zinc-400 uppercase tracking-widest text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-zinc-800">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/30 transition-colors">
                                    
                                    <!-- Nom -->
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-zinc-700 flex items-center justify-center text-gray-700 dark:text-zinc-300 font-bold shadow-inner">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $user->name }}</span>
                                        </div>
                                    </td>

                                    <!-- Email -->
                                    <td class="py-4 px-6 text-sm font-medium text-gray-600 dark:text-zinc-300">
                                        {{ $user->email }}
                                    </td>

                                    <!-- Rôle avec Badge Lumineux -->
                                    <td class="py-4 px-6">
                                        <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-extrabold rounded-lg border shadow-sm
                                            @if($user->role == 'admin') bg-purple-100 text-purple-800 border-purple-200 dark:bg-purple-500/10 dark:text-purple-400 dark:border-purple-500/20
                                            @elseif($user->role == 'controleur') bg-orange-100 text-orange-800 border-orange-200 dark:bg-orange-500/10 dark:text-orange-400 dark:border-orange-500/20
                                            @else bg-blue-100 text-blue-800 border-blue-200 dark:bg-blue-500/10 dark:text-blue-400 dark:border-blue-500/20 @endif">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    
                                    <!-- Boutons d'action modernes -->
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            
                                            <!-- Bouton Modifier -->
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center gap-1 bg-blue-50 hover:bg-blue-100 text-blue-700 dark:bg-blue-500/10 dark:hover:bg-blue-500/20 dark:text-blue-400 font-bold py-1.5 px-3 rounded-lg transition-colors text-xs border border-blue-200 dark:border-blue-500/20">
                                                Éditer
                                            </a>

                                            <!-- Bouton Supprimer -->
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce compte de manière définitive ?');" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-1 bg-red-50 hover:bg-red-100 text-red-700 dark:bg-red-500/10 dark:hover:bg-red-500/20 dark:text-red-400 font-bold py-1.5 px-3 rounded-lg transition-colors text-xs border border-red-200 dark:border-red-500/20">
                                                    Supprimer
                                                </button>
                                            </form>
                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</x-layouts.app>