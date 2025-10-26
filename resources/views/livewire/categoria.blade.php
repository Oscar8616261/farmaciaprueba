<div class="container mx-auto px-8">
    <!-- Título principal -->
    <h2 class="text-center text-4xl font-bold mb-10 relative text-yellow-500">
        <span class="italic text-gray-900">CATEGORÍAS</span>
        <div class="absolute left-0 top-1/2 transform -translate-y-2/4 w-1/4 border-t-2 border-gray-300"></div>
        <div class="absolute right-0 top-1/2 transform -translate-y-2/4 w-1/4 border-t-2 border-gray-300"></div>
    </h2>

    {{-- ==================== SECCIÓN TIPOS ==================== --}}
    <div class="mb-12">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-semibold text-gray-800">Tipos de Productos</h3>
            <button wire:click="openModalTipos" class="bg-red-600 text-white font-bold px-6 py-3 rounded-md shadow-lg transition hover:bg-red-700">
                NUEVO TIPO
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-red-600 text-white">
                        <th class="px-4 py-2 border">Nombre</th>
                        <th class="px-4 py-2 border">Foto</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tipos as $item)
                        <tr class="text-center hover:bg-gray-100">
                            <td class="px-4 py-2 border">{{ $item->nombre }}</td>
                            <td class="px-4 py-2 border">
                                @if($item->foto)
                                    <img src="{{ asset('storage/img/'.$item->foto) }}" alt="Foto" class="w-16 h-16 mx-auto rounded-md object-cover">
                                @else
                                    <span class="text-gray-400 italic">Sin foto</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border">
                                <button wire:click.prevent="editarTipo({{ $item->id_tipo }})" 
                                    class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center text-gray-600">No hay tipos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ==================== SECCIÓN PRESENTACIÓN ==================== --}}
    <div class="mb-12">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-semibold text-gray-800">Presentaciones</h3>
            <button wire:click="openModalPresentacion" class="bg-red-600 text-white font-bold px-6 py-3 rounded-md shadow-lg transition hover:bg-red-700">
                NUEVA PRESENTACIÓN
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-red-600 text-white">
                        <th class="px-4 py-2 border">Tipo de Presentación</th>
                        <th class="px-4 py-2 border">Código</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($presentaciones as $item)
                        <tr class="text-center hover:bg-gray-100">
                            <td class="px-4 py-2 border">{{ $item->tipoPresentacion }}</td>
                            <td class="px-4 py-2 border">{{ $item->codigo }}</td>
                            <td class="px-4 py-2 border">
                                <button wire:click.prevent="editarPresentacion({{ $item->id_presentacion }})"
                                    class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center text-gray-600">No hay presentaciones registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($showModalTipos)
        @include('livewire.modalTipo')
    @endif

    @if($showModalPresentacion)
        @include('livewire.modalPresentacion')
    @endif
</div>
