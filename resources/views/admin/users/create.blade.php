<x-layouts.app title="Créer un compte">
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-zinc-900 shadow-xl rounded-3xl overflow-hidden border border-gray-200 dark:border-zinc-800 p-8 transition-all">
                
                <div class="flex items-center gap-3 mb-8 border-b border-gray-200 dark:border-zinc-800 pb-5">
                    <div class="bg-purple-100 dark:bg-purple-900/30 p-2.5 rounded-xl">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">Créer un nouvel utilisateur</h2>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 dark:bg-red-500/10 border-l-4 border-red-500 p-4 mb-8 rounded-r-xl">
                        <p class="font-bold text-red-800 dark:text-red-400 mb-1">Attention, veuillez corriger ces erreurs :</p>
                        <ul class="list-disc ml-5 text-sm text-red-700 dark:text-red-300">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-zinc-300 mb-2 uppercase tracking-wide">Nom complet de l'employé *</label>
                        <input type="text" name="name" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-zinc-800 text-gray-900 dark:text-white border border-gray-300 dark:border-zinc-700 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none font-medium placeholder-gray-400 dark:placeholder-zinc-500 transition-all shadow-sm" placeholder="Ex: Raphael" required autocomplete="off">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-zinc-300 mb-2 uppercase tracking-wide">Adresse Email *</label>
                        <input type="email" name="email" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-zinc-800 text-gray-900 dark:text-white border border-gray-300 dark:border-zinc-700 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none font-medium placeholder-gray-400 dark:placeholder-zinc-500 transition-all shadow-sm" placeholder="Ex: raphael.tshomba@douane.cd" required autocomplete="off">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-zinc-300 mb-2 uppercase tracking-wide">Mot de passe provisoire *</label>
                        <input type="password" name="password" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-zinc-800 text-gray-900 dark:text-white border border-gray-300 dark:border-zinc-700 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none font-medium placeholder-gray-400 dark:placeholder-zinc-500 transition-all shadow-sm" placeholder="Minimum 6 caractères" required autocomplete="new-password">
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 dark:text-zinc-300 mb-2 uppercase tracking-wide">Attribution du rôle *</label>
                        <select name="role" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-zinc-800 text-gray-900 dark:text-white border border-gray-300 dark:border-zinc-700 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none font-bold appearance-none cursor-pointer shadow-sm transition-all" required>
                            <option value="">-- Sélectionnez un rôle pour cet utilisateur --</option>
                            <option value="agent">Agent d'enregistrement (Saisie des marchandises)</option>
                            <option value="controleur">Contrôleur Douanier (Vérification et validation)</option>
                            <option value="admin">Administrateur (Gestion du système complet)</option>
                        </select>
                        <p class="text-xs text-gray-500 dark:text-zinc-400 mt-2 font-medium flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Le rôle détermine à quelles pages l'utilisateur aura accès.
                        </p>
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-zinc-800">
                        <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white font-bold transition-colors">
                            &larr; Retour
                        </a>
                        <button type="submit" class="bg-purple-600 hover:bg-purple-500 text-white font-extrabold py-3.5 px-8 rounded-xl shadow-lg shadow-purple-500/30 transform hover:-translate-y-1 transition-all">
                            Valider la création
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-layouts.app>