<div class="container mx-auto px-8">
    <!-- Título de la sección -->
    <h2 class="text-center text-4xl font-bold mb-8 relative text-yellow-500">
        <span class="italic text-gray-900">CONTROL DE VENCIMIENTOS</span>
        <div class="absolute left-0 top-1/2 transform -translate-y-2/4 w-1/4 border-t-2 border-gray-300"></div>
        <div class="absolute right-0 top-1/2 transform -translate-y-2/4 w-1/4 border-t-2 border-gray-300"></div>
    </h2>
    <div class="flex justify-between items-center mb-6">
        <button wire:click="openModal()" class="bg-red-600 text-white font-bold px-6 py-3 rounded-md shadow-lg transition duration-300 hover:bg-red-700 text-lg">NUEVO CONTROL</button>
        <div class="flex items-center relative w-full max-w-[350px]">
            <input type="text" wire:model.debounce.500ms="search" wire:keydown.enter="clickBuscar" placeholder="Buscar..." class="py-2 pl-10 pr-4 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#f94f2c] focus:border-[#f94f2c] h-10 text-lg">
            <button wire:click="clickBuscar" class="absolute left-3 top-2/4 transform -translate-y-2/4 text-gray-500 text-lg">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-red-600 text-white">
                    <th class="px-4 py-2 border">Producto</th>
                    <th class="px-4 py-2 border">Fecha de Vencimiento</th>
                    <th class="px-4 py-2 border">Días de Alerta</th>
                    <th class="px-4 py-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($control_vencimientos as $item)
                    <tr class="text-center">
                        <td class="px-4 py-2 border">{{ $item->producto_id }}</td>
                        <td class="px-4 py-2 border">{{ $item->fecha_vencimiento }}</td>
                        <td class="px-4 py-2 border">{{ $item->dias_alerta }}</td>
                        <td class="px-4 py-2 border">
                            <button wire:click.prevent="editar({{$item->id_control_vencimiento}})" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                                <i class="fa-solid fa-pen w-5 text-white-500"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-gray-600">No hay controles de vencimiento registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($showModal)
        @include('livewire.modalControlVencimiento')
    @endif
</div>
