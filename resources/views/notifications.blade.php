<x-layouts.app title="Mes Notifications">
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <h2 class="text-3xl font-extrabold text-gray-800 dark:text-white flex items-center gap-3">
                    🔔 Centre de Notifications
                </h2>

                @if(auth()->user()->unreadNotifications->count() > 0)
                    <form action="{{ route('notifications.read') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-xl text-sm transition shadow-lg transform hover:-translate-y-1">
                            ✔ Tout marquer comme lu
                        </button>
                    </form>
                @endif
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
                
                @forelse($notifications as $notification)
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition flex flex-col md:flex-row items-start gap-4 {{ is_null($notification->read_at) ? 'bg-blue-50/50 dark:bg-blue-900/20' : '' }}">
                        
                        <!-- Icône de status -->
                        <div class="text-4xl mt-1 shrink-0">
                            @if($notification->data['statut'] == 'nouvelle') 📦
                            @elseif($notification->data['statut'] == 'validée') 🟢
                            @elseif($notification->data['statut'] == 'bloquée') 🔴
                            @else 🔵 @endif
                        </div>

                        <div class="flex-1 w-full">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1">
                                Réf : <a href="{{ route('marchandises.controle', $notification->data['marchandise_id']) }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $notification->data['reference'] }}</a>
                            </h4>
                            <p class="text-gray-700 dark:text-gray-300 font-medium text-base mb-2">
                                {{ $notification->data['message'] }}
                            </p>
                            
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-gray-500 dark:text-gray-400 font-bold bg-gray-100 dark:bg-gray-900 px-3 py-1 rounded-lg">
                                    🕒 {{ $notification->created_at->format('d/m/Y à H:i') }}
                                </span>
                                
                                @if(is_null($notification->read_at))
                                    <span class="text-blue-600 dark:text-blue-400 uppercase text-[10px] font-extrabold tracking-wider px-2 py-1 bg-blue-100 dark:bg-blue-900/50 rounded animate-pulse">
                                        Nouveau
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-16 text-center">
                        <span class="text-6xl opacity-30">📭</span>
                        <h3 class="mt-6 text-2xl font-bold text-gray-800 dark:text-white">Boîte de réception vide</h3>
                        <p class="text-gray-500 dark:text-gray-400 mt-2 text-lg">Toute l'activité de l'entrepôt apparaîtra ici.</p>
                    </div>
                @endforelse

            </div>

        </div>
    </div>
</x-layouts.app>