<x-layouts.app title="Enregistrer une Marchandise">
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Ajout d'une animation d'apparition (animate-fade-in) -->
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-8 border border-gray-100 dark:border-gray-700 transition-all duration-300">
                
                <h2 class="text-2xl font-extrabold mb-6 text-gray-800 dark:text-white flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-4">
                    <span class="bg-blue-100 dark:bg-blue-900/50 text-blue-600 p-2 rounded-lg">📦</span>
                    Saisie d'une nouvelle marchandise
                </h2>

                @if ($errors->any())
                    <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
                        <ul class="list-disc ml-5 mt-1 text-red-700 dark:text-red-400 font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('marchandises.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Numéro de référence (Unique) *</label>
                        <!-- CORRECTION DU CSS ICI : Fond sombre, texte blanc en dark mode -->
                        <input type="text" name="reference" class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all shadow-sm" placeholder="Ex: REF-2026-001" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Importateur / Propriétaire *</label>
                        <input type="text" name="importateur" class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all shadow-sm" placeholder="Ex: Société Import-Export SARL" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Description détaillée *</label>
                        <textarea name="description" rows="4" class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all shadow-sm" placeholder="Nature des produits, quantité, poids..." required></textarea>
                    </div>

                    <div class="p-5 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl group hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors cursor-pointer">
                        <label class="block text-blue-800 dark:text-blue-300 font-bold mb-2 cursor-pointer">📄 Joindre un document (Optionnel)</label>
                        <p class="text-xs text-blue-600 dark:text-blue-400 mb-3">Formats acceptés : PDF, JPG, PNG (Max: 5 Mo).</p>
                        <input type="file" name="document_file" accept=".pdf,.jpg,.jpeg,.png" class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer transition-all">
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('marchandises.index') }}" class="text-gray-500 hover:text-gray-800 dark:hover:text-white font-medium transition-colors">&larr; Annuler</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-1 transition-all duration-200">
                            Enregistrer la marchandise
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-layouts.app>