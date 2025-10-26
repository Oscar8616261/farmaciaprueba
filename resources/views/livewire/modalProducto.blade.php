<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-md z-50">
    <div class="max-w-3xl w-full mx-4 p-6 bg-white rounded-2xl shadow-xl">
        <h2 class="text-center text-2xl font-semibold text-gray-800 mb-6">Detalles del Producto</h2>

        <form wire:submit.prevent="enviarClick" class="grid grid-cols-2 gap-x-6 gap-y-4">
            <div class="flex flex-col space-y-4">
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Producto</label>
                    <input id="nombre" wire:model="nombre" type="text"
                        class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
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

                <div>
                    <label for="precioCompra" class="block text-sm font-medium text-gray-700">Precio Compra</label>
                    <input id="precioCompra" wire:model="precioCompra" type="text"
                        class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                    @error('precioCompra') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="precioVenta" class="block text-sm font-medium text-gray-700">Precio Venta</label>
                    <input id="precioVenta" wire:model="precioVenta" type="text"
                        class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                    @error('precioVenta') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

            </div>
            <div class="flex flex-col space-y-4">
                <div>
                    <label for="proveedor" class="block text-sm font-medium text-gray-700">Proveedor</label>
                    <select id="proveedor" wire:model="proveedor"
                        class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                        <option value="">Selec. un proveedor</option>
                        @foreach ($proveedores as $prov)
                            <option value="{{ $prov->id_proveedor }}">{{ $prov->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="presentacion" class="block text-sm font-medium text-gray-700">Presentación</label>
                    <select id="presentacion" wire:model="presentacion"
                        class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                        <option value="">Selec. una presentacion</option>
                        @foreach ($presentaciones as $pres)
                            <option value="{{ $pres->id_presentacion }}">{{ $pres->tipoPresentacion }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo</label>
                    <select id="tipo" wire:model="tipo"
                        class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                        <option value="">Selec. una tipo</option>
                        @foreach ($tipos as $tip)
                            <option value="{{ $tip->id_tipo }}">{{ $tip->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="stockMinimo" class="block text-sm font-medium text-gray-700">Stock Mínimo</label>
                    <input id="stockMinimo" wire:model="stockMinimo" type="number" min="0"
                        class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                    @error('stockMinimo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="fechaVencimiento" class="block text-sm font-medium text-gray-700">Fecha Vencimiento</label>
                    <input id="fechaVencimiento" wire:model="fechaVencimiento" type="date"
                        class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                    @error('fechaVencimiento') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Producto Controlado</label>
                    <div class="flex gap-4">
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model="controlado" value="si" class="form-radio text-orange-500">
                            <span class="ml-2">Sí</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model="controlado" value="no" class="form-radio text-orange-500">
                            <span class="ml-2">No</span>
                        </label>
                    </div>
                    @error('controlado') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-span-2 flex justify-between space-x-4 mt-4">
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