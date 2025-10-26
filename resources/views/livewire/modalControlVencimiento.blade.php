<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-md z-50">
    <div class="max-w-md w-full mx-4 p-6 bg-white rounded-2xl shadow-xl">
        <h2 class="text-center text-2xl font-semibold text-gray-800 mb-6">Detalles del Control de Vencimiento</h2>

        <form wire:submit.prevent="enviarClick" class="space-y-4">
            <div>
                <label for="producto_id" class="block text-sm font-medium text-gray-700">Producto</label>
                <select id="producto_id" wire:model="producto_id"
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                    <option value="">Seleccione un producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
                @error('producto_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="fecha_vencimiento" class="block text-sm font-medium text-gray-700">Fecha de Vencimiento</label>
                <input id="fecha_vencimiento" wire:model="fecha_vencimiento" type="date"
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                @error('fecha_vencimiento') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="dias_alerta" class="block text-sm font-medium text-gray-700">Días de Alerta</label>
                <input id="dias_alerta" wire:model="dias_alerta" type="text"
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                @error('dias_alerta') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
