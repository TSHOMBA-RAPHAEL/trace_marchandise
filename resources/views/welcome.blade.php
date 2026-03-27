<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TraceDouane - Système de Traçabilité</title>

    <!-- Polices Google Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Animations CSS personnalisées pour l'effet "Wow" -->
    <style>
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body class="antialiased bg-zinc-950 text-white min-h-screen selection:bg-blue-500 selection:text-white overflow-x-hidden relative">

    <!-- EFFETS DE LUMIÈRE EN ARRIÈRE-PLAN -->
    <div class="fixed inset-0 w-full h-full z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-600 rounded-full mix-blend-screen filter blur-[100px] opacity-30 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-indigo-600 rounded-full mix-blend-screen filter blur-[100px] opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-purple-600 rounded-full mix-blend-screen filter blur-[100px] opacity-30 animate-blob animation-delay-4000"></div>
        <!-- Grille de fond subtile -->
        <div class="absolute inset-0 bg-[url('https://laravel.com/assets/img/welcome/background.svg')] bg-center opacity-20 mask-image:linear-gradient(to_bottom,white,transparent)"></div>
    </div>

    <!-- CONTENU DE LA PAGE -->
    <div class="relative z-10">
        
        <!-- BARRE DE NAVIGATION -->
        <header class="container mx-auto px-6 py-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-2.5 rounded-xl shadow-lg shadow-blue-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <span class="text-2xl font-black tracking-tight text-white">Trace<span class="text-blue-500">Douane</span></span>
            </div>

            <nav>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="group relative inline-flex items-center justify-center px-6 py-2.5 text-sm font-bold text-white transition-all duration-200 bg-white/10 border border-white/20 rounded-full hover:bg-white/20 hover:scale-105">
                            Accéder à mon espace &rarr;
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="group relative inline-flex items-center justify-center px-8 py-3 text-sm font-bold text-white transition-all duration-200 bg-gradient-to-r from-blue-600 to-indigo-600 border border-transparent rounded-full hover:from-blue-500 hover:to-indigo-500 shadow-[0_0_20px_rgba(59,130,246,0.4)] hover:shadow-[0_0_30px_rgba(59,130,246,0.6)] hover:-translate-y-1">
                            Connexion Agent
                            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        </a>
                    @endauth
                @endif
            </nav>
        </header>

        <!-- SECTION PRINCIPALE (HERO) -->
        <main class="container mx-auto px-6 pt-16 pb-24 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-sm font-bold mb-8 animate-fade-in-up">
                <span class="relative flex h-2.5 w-2.5">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-500"></span>
                </span>
                Système Douanier Actif et Sécurisé
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-8 leading-tight">
                Contrôlez et Tracez <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-400">chaque marchandise.</span>
            </h1>
            
            <p class="mt-4 text-lg md:text-xl text-gray-400 max-w-3xl mx-auto font-medium leading-relaxed mb-12">
                Plateforme centralisée destinée aux agents et contrôleurs douaniers. <br class="hidden md:block">
                Modernisez l'enregistrement, accélérez les inspections et conservez un historique infaillible de toutes les opérations avant dédouanement.
            </p>

            <!-- BOUTON CENTRAL -->
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-block bg-white text-zinc-900 font-extrabold text-lg py-4 px-10 rounded-full hover:bg-gray-100 hover:scale-105 transition-all shadow-[0_0_40px_rgba(255,255,255,0.2)]">
                        Ouvrir le Tableau de bord
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-block bg-white text-zinc-900 font-extrabold text-lg py-4 px-10 rounded-full hover:bg-gray-100 hover:scale-105 transition-all shadow-[0_0_40px_rgba(255,255,255,0.2)]">
                        Portail de Connexion
                    </a>
                @endauth
            @endif

            <!-- 3 CARTES DE FONCTIONNALITÉS (Glassmorphism) -->
            <div class="mt-24 grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                
                <!-- Carte 1 -->
                <div class="glass-card p-8 rounded-3xl hover:-translate-y-2 transition-transform duration-300 group">
                    <div class="w-14 h-14 rounded-2xl bg-blue-500/10 flex items-center justify-center border border-blue-500/20 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Enregistrement Rapide</h3>
                    <p class="text-gray-400 font-medium leading-relaxed">
                        Les agents d'enregistrement saisissent les nouvelles arrivées et joignent les documents justificatifs en quelques clics.
                    </p>
                </div>

                <!-- Carte 2 -->
                <div class="glass-card p-8 rounded-3xl hover:-translate-y-2 transition-transform duration-300 group relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-purple-500/5 z-0"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-2xl bg-indigo-500/10 flex items-center justify-center border border-indigo-500/20 mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Contrôle Strict</h3>
                        <p class="text-gray-400 font-medium leading-relaxed">
                            Les contrôleurs douaniers inspectent les dossiers, valident les marchandises ou bloquent celles présentant des anomalies.
                        </p>
                    </div>
                </div>

                <!-- Carte 3 -->
                <div class="glass-card p-8 rounded-3xl hover:-translate-y-2 transition-transform duration-300 group">
                    <div class="w-14 h-14 rounded-2xl bg-purple-500/10 flex items-center justify-center border border-purple-500/20 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Audit & Traçabilité</h3>
                    <p class="text-gray-400 font-medium leading-relaxed">
                        Le système conserve un historique infalsifiable de chaque action, avec exportation Excel pour la supervision administrative.
                    </p>
                </div>

            </div>
        </main>

        <!-- FOOTER (Projet de fin d'études) -->
        <footer class="container mx-auto px-6 py-8 border-t border-white/10 text-center">
            <p class="text-sm text-gray-500 font-medium">
                &copy; {{ date('Y') }} - Application développée dans le cadre d'un projet de fin d'études. <br>
                <span class="text-gray-600">Conception et développement web.</span>
            </p>
        </footer>

    </div>

</body>
</html>