<x-layouts.app title="Modifier un compte">
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-zinc-900 shadow-xl rounded-3xl overflow-hidden border border-gray-200 dark:border-zinc-800 p-8 transition-all">
                
                <div class="flex items-center gap-3 mb-8 border-b border-gray-200 dark:border-zinc-800 pb-5">
                    <div class="bg-blue-100 dark:bg-blue-900/30 p-2.5 rounded-xl">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">Modifier le compte de <span class="text-blue-600 dark:text-blue-400">{{ $user->name }}</span></h2>
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

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-zinc-300 mb-2 uppercase tracking-wide">Nom complet</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-zinc-800 text-gray-900 dark:text-white border border-gray-300 dark:border-zinc-700 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none font-medium transition-all shadow-sm" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-zinc-300 mb-2 uppercase tracking-wide">Adresse Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-zinc-800 text-gray-900 dark:text-white border border-gray-300 dark:border-zinc-700 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none font-medium transition-all shadow-sm" required>
                    </div>

                    <div class="relative">
                        <label class="block text-sm font-bold text-gray-700 dark:text-zinc-300 mb-2 uppercase tracking-wide">Nouveau mot de passe <span class="text-gray-400 dark:text-zinc-500 normal-case tracking-normal text-xs">(Optionnel)</span></label>
                        <input type="password" name="password" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-zinc-800 text-gray-900 dark:text-white border border-yellow-300 dark:border-yellow-600/50 rounded-xl focus:ring-2 focus:ring-yellow-500 outline-none font-medium placeholder-gray-400 dark:placeholder-zinc-600 transition-all shadow-sm" placeholder="Laissez vide pour conserver l'ancien" autocomplete="new-password">
                        
                        <div class="mt-2 p-3 bg-yellow-50 dark:bg-yellow-900/10 border border-yellow-100 dark:border-yellow-500/20 rounded-lg flex items-start gap-2">
                            <span class="text-yellow-600 dark:text-yellow-500">⚠️</span>
                            <p class="text-xs text-yellow-700 dark:text-yellow-400 font-medium">Ne remplissez ce champ que si l'utilisateur a perdu son mot de passe et a demandé une réinitialisation.</p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 dark:text-zinc-300 mb-2 uppercase tracking-wide">Attribution du rôle</label>
                        <select name="role" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-zinc-800 text-gray-900 dark:text-white border border-gray-300 dark:border-zinc-700 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none font-bold appearance-none cursor-pointer shadow-sm transition-all" required>
                            <option value="agent" {{ $user->role == 'agent' ? 'selected' : '' }}>Agent d'enregistrement</option>
                            <option value="controleur" {{ $user->role == 'controleur' ? 'selected' : '' }}>Contrôleur Douanier</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrateur</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-zinc-800">
                        <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white font-bold transition-colors">
                            &larr; Annuler
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-extrabold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-500/30 transform hover:-translate-y-1 transition-all">
                            Sauvegarder
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-layouts.app>