<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-md z-50">
    <div class="max-w-md w-full mx-4 p-6 bg-white rounded-2xl shadow-xl">
        <h2 class="text-center text-2xl font-semibold text-gray-800 mb-6">
            {{ $presentacion_id ? 'Editar Presentación' : 'Nueva Presentación' }}
        </h2>
        <form wire:submit.prevent="enviarClickPresentacion" class="space-y-4">
            <div>
                <label for="tipoPresentacion" class="block text-sm font-medium text-gray-700">Tipo de Presentación</label>
                <input id="tipoPresentacion" wire:model="tipoPresentacion" type="text"
                    class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-red-500 focus:outline-none">
                @error('tipoPresentacion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="codigo" class="block text-sm font-medium text-gray-700">Código</label>
                <input id="codigo" wire:model="codigo" type="text"
                    class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-red-500 focus:outline-none">
                @error('codigo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="flex justify-between space-x-4 mt-4">
                <button type="submit"
                    class="w-full bg-red-600 text-white font-bold py-3 rounded-md hover:bg-red-700 transition">
                    Guardar
                </button>
                <button type="button" wire:click="closeModalPresentacion"
                    class="w-full bg-gray-300 text-gray-800 font-bold py-3 rounded-md hover:bg-gray-400 transition">
                    Cerrar
                </button>
            </div>
        </form>
    </div>
</div>