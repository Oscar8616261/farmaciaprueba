<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-md z-50">
    <div class="max-w-md w-full mx-4 p-6 bg-white rounded-2xl shadow-xl">
        <h2 class="text-center text-2xl font-semibold text-gray-800 mb-6">Detalles de la Alerta</h2>

        <form wire:submit.prevent="enviarClick" class="space-y-4">
            <div>
                <label for="tipo_alerta" class="block text-sm font-medium text-gray-700">Tipo de Alerta</label>
                <input id="tipo_alerta" wire:model="tipo_alerta" type="text"
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                @error('tipo_alerta') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="mensaje" class="block text-sm font-medium text-gray-700">Mensaje</label>
                <textarea id="mensaje" wire:model="mensaje"
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 transition"></textarea>
                @error('mensaje') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center">
                <input id="leida" wire:model="leida" type="checkbox"
                    class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                <label for="leida" class="ml-2 block text-sm text-gray-900">Leída</label>
                @error('leida') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-between space-x-4 mt-4">
                <button type="submit"
                    class="w-full bg-red-600 text-white font-bold py-3 rounded-md transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    Enviar
                </button>
                <button type="button" wire:click="closeModal"
                    class="w-full bg-gray-300 text-gray-800 font-bold py-3 rounded-md transition hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Cerrar
                </button>
            </div>
        </form>
    </div>
</div>
