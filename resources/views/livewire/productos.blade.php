<div class="container mx-auto px-0">
    <h2 class="text-center text-4xl font-bold mb-8 relative text-yellow-500">
        <span class="italic text-gray-900">PRODUCTOS</span>
        <div class="absolute left-0 top-1/2 transform -translate-y-2/4 w-1/4 border-t-2 border-gray-300"></div>
        <div class="absolute right-0 top-1/2 transform -translate-y-2/4 w-1/4 border-t-2 border-gray-300"></div>
    </h2>

    <div class="flex justify-between items-center mb-6">
        <button wire:click="openModal()" 
                class="bg-red-600 text-white font-bold px-6 py-3 rounded-md shadow-lg transition duration-300 hover:bg-red-700 text-lg">
            NUEVO PRODUCTO
        </button>

        <div class="flex items-center relative w-full max-w-[350px]">
            <input type="text" wire:model.debounce.500ms="search" wire:keydown.enter="clickBuscar"
                   placeholder="Buscar..." 
                   class="py-2 pl-10 pr-4 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#f94f2c] focus:border-[#f94f2c] h-10 text-lg">
            <button wire:click="clickBuscar" class="absolute left-3 top-2/4 transform -translate-y-2/4 text-gray-500 text-lg">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <!-- Tabla de productos -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-100 border-b border-gray-300">
                <tr>
                    <th class="py-3 px-4 text-left text-gray-700 font-semibold">Foto</th>
                    <th class="py-3 px-4 text-left text-gray-700 font-semibold">Nombre</th>
                    <th class="py-3 px-4 text-left text-gray-700 font-semibold">Compra</th>
                    <th class="py-3 px-4 text-left text-gray-700 font-semibold">Venta</th>
                    <th class="py-3 px-4 text-left text-gray-700 font-semibold">Stock</th>
                    <th class="py-3 px-4 text-left text-gray-700 font-semibold">Vencimiento</th>
                    <th class="py-3 px-4 text-left text-gray-700 font-semibold">Proveedor</th>
                    <th class="py-3 px-4 text-left text-gray-700 font-semibold">Presentación</th>
                    <th class="py-3 px-4 text-center text-gray-700 font-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productos as $item)
                    <tr class="border-b transition duration-200 ease-in-out {{ $item->estado == 'inactivo' ? 'bg-red-200 hover:bg-red-300' : ($item->stock <= $item->stockMinimo ? 'bg-yellow-200 hover:bg-yellow-300' : 'hover:bg-gray-50') }}">
                        <td class="py-3 px-4">
                            <img src="/storage/img/{{$item->foto}}" alt="Foto" class="w-14 h-14 object-cover rounded">
                        </td>
                        <td class="py-3 px-4 font-semibold text-gray-900">{{$item->nombre}}</td>
                        <td class="py-3 px-4 text-gray-900 font-semibold">Bs {{$item->precioCompra}}</td>
                        <td class="py-3 px-4 text-gray-900 font-semibold">Bs {{$item->precioVenta}}</td>
                        <td class="py-3 px-4 text-gray-700">{{$item->stock}}</td>
                        <td class="py-3 px-4 text-gray-700">{{$item->fechaVencimiento ?? 'N/A'}}</td>
                        <td class="py-3 px-4 text-orange-500 font-bold">{{ $item->proveedor->nombre ?? 'N/A' }}</td>
                        <td class="py-3 px-4 text-orange-500 font-bold">{{ $item->presentacion->tipoPresentacion ?? 'N/A' }}</td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <button wire:click.prevent="editar({{$item->id_producto}})" 
                                        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
                                    <i class="fa-solid fa-pen w-5 text-white-500"></i>
                                </button>
                                @if($item->estado == 'inactivo')
                                    <button wire:click.prevent="activar({{$item->id_producto}})" 
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-sm">
                                        <i class="fa-solid fa-check w-5 text-white-500"></i>
                                    </button>
                                @else
                                    <button wire:click.prevent="delete({{$item->id_producto}})" 
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">
                                        <i class="fa-solid fa-trash w-5 text-white-500"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="14" class="text-center py-6 text-gray-500">
                            No hay Productos disponibles
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($showModal)
        @include('livewire.modalProducto')
    @endif
</div>
