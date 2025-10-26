<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-md z-50">
    <div class="max-w-md w-full mx-4 p-6 bg-white rounded-2xl shadow-xl">
        <h2 class="text-center text-2xl font-semibold text-gray-800 mb-6">
            {{ $tipo_id ? 'Editar Tipo' : 'Nuevo Tipo' }}
        </h2>
        <form wire:submit.prevent="enviarClickTipo" class="space-y-4">
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input id="nombre" wire:model="nombre" type="text"
                    class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-red-500 focus:outline-none">
                @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
                <input id="foto" wire:model="foto" type="file"
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                @error('foto') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            @if ($foto)
                <div class="text-center">
                    @if (is_object($foto))
                        <img src="{{ $foto->temporaryUrl() }}" alt="Preview" class="w-32 h-auto rounded-lg mx-auto">
                    @else
                        <img src="{{ asset('storage/img/' . $foto) }}" alt="Preview" class="w-32 h-auto rounded-lg mx-auto">
                    @endif
                </div>
            @endif

            <div class="flex justify-between space-x-4 mt-4">
                <button type="submit"
                    class="w-full bg-red-600 text-white font-bold py-3 rounded-md hover:bg-red-700 transition">
                    Guardar
                </button>
                <button type="button" wire:click="closeModalTipos"
                    class="w-full bg-gray-300 text-gray-800 font-bold py-3 rounded-md hover:bg-gray-400 transition">
                    Cerrar
                </button>
            </div>
        </form>
    </div>
</div>