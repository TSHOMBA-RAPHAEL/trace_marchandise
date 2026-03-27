<x-layouts.app title="Modifier Marchandise">
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white shadow-md rounded-lg p-8 border border-gray-200">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-4">Modifier la marchandise : <span class="text-blue-600">{{ $marchandise->reference }}</span></h2>

                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <ul class="list-disc ml-5 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulaire (Méthode PUT pour Laravel) -->
                <form action="{{ route('marchandises.update', $marchandise->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label class="block text-gray-700 font-bold mb-2">Numéro de référence</label>
                        <input type="text" name="reference" value="{{ $marchandise->reference }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-5">
                        <label class="block text-gray-700 font-bold mb-2">Importateur / Propriétaire</label>
                        <input type="text" name="importateur" value="{{ $marchandise->importateur }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-8">
                        <label class="block text-gray-700 font-bold mb-2">Description détaillée</label>
                        <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ $marchandise->description }}</textarea>
                    </div>

                    <div class="flex items-center justify-between border-t pt-4">
                        <a href="{{ route('marchandises.index') }}" class="text-gray-500 hover:text-gray-800 font-medium">&larr; Annuler</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition">
                            Mettre à jour
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-layouts.app>