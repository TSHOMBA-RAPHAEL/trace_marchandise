<x-layouts::auth title="Connexion - TraceDouane">
    <div class="flex flex-col gap-6">
        
        <!-- Logo et Titre personnalisés -->
        <div class="flex flex-col items-center justify-center text-center mb-2 mt-4">
            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-3 rounded-2xl shadow-lg mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <h1 class="text-3xl font-extrabold text-zinc-900 dark:text-white tracking-tight">Trace<span class="text-blue-600 dark:text-blue-500">Douane</span></h1>
            <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400 mt-2 uppercase tracking-widest">Portail Sécurisé</p>
        </div>

        <!-- Message d'erreur potentiel -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Adresse Email -->
            <flux:input
                name="email"
                label="Adresse Email"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="agent@douane.cd"
            />

            <!-- Mot de passe -->
            <div class="relative">
                <flux:input
                    name="password"
                    label="Mot de passe"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    viewable
                />

                @if (Route::has('password.request')) 
                    <flux:link class="absolute top-0 text-sm end-0 text-blue-600 dark:text-blue-400" :href="route('password.request')" wire:navigate>
                        Oublié ?
                    </flux:link>
                @endif
            </div>

            <!-- Se souvenir de moi -->
            <flux:checkbox name="remember" label="Se souvenir de ma session" :checked="old('remember')" />

            <!-- Bouton de connexion -->
            <div class="flex items-center justify-end mt-2">
                <flux:button variant="primary" type="submit" class="w-full text-lg py-2" data-test="login-button">
                    Se connecter
                </flux:button>
            </div>
        </form>

        <!-- Message de sécurité qui remplace le bouton d'inscription -->
        <div class="mt-4 text-center border-t border-zinc-200 dark:border-zinc-800 pt-6">
            <p class="text-xs text-zinc-500 dark:text-zinc-400 font-medium flex items-center justify-center gap-1">
                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                Accès restreint. Seul l'Administrateur peut créer des comptes.
            </p>
        </div>

    </div>
</x-layouts::auth>