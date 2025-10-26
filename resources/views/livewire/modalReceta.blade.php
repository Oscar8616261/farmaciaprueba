<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-md z-50">
    <div class="max-w-md w-full mx-4 p-6 bg-white rounded-2xl shadow-xl">
        <h2 class="text-center text-2xl font-semibold text-gray-800 mb-6">Detalles del Cliente</h2>

        <form wire:submit.prevent="enviarRecetaClick" class="space-y-4">
            <div>
                <label for="nombreDoctor" class="block text-sm font-medium text-gray-700">Nombre del Doctor</label>
                <input id="nombreDoctor" wire:model="nombreDoctor" type="text"
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                @error('nombreDoctor') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="fechaEmision" class="block text-sm font-medium text-gray-700">Fecha de Emisión</label>
                <input id="fechaEmision" wire:model="fechaEmision" type="date"
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                @error('fechaEmision') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="diagnostico" class="block text-sm font-medium text-gray-700">Diagnóstico</label>
                <textarea id="diagnostico" wire:model="diagnostico" rows="4"
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 transition"></textarea>
                @error('diagnostico') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-between space-x-4 mt-4">
                <button type="submit"
                    class="w-full bg-red-600 text-white font-bold py-3 rounded-md transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    Enviar
                </button>
                <button type="button" wire:click="closeModalReceta"
                    class="w-full bg-gray-300 text-gray-800 font-bold py-3 rounded-md transition hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Cerrar
                </button>
            </div>
        </form>
    </div>
</div>