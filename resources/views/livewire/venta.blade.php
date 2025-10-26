<div class="container mx-auto px-0">
    <h2 class="text-center text-4xl font-bold mb-8 relative text-yellow-500">
        <span class="italic text-gray-900">VENTAS</span>
        <div class="absolute left-0 top-1/2 transform -translate-y-2/4 w-1/4 border-t-2 border-gray-300"></div>
        <div class="absolute right-0 top-1/2 transform -translate-y-2/4 w-1/4 border-t-2 border-gray-300"></div>
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-4 rounded-lg shadow-md col-span-1">
            <h2 class="text-xl font-semibold mb-4">Datos del Cliente</h2>
            <input wire:model="ciCliente" wire:keydown.enter="buscarCliente" type="text"
                placeholder="Ingrese CI del Cliente..."
                class="w-full p-2 border rounded-md mb-4 text-sm">

            <button wire:click="buscarCliente"
                class="bg-red-600 text-white w-full py-2 rounded-md hover:bg-red-700 transition duration-300">
                Buscar Cliente
            </button>
            <button wire:click="openModalReceta"
                class="bg-red-600 text-white w-full py-2 rounded-md hover:bg-red-700 transition duration-300">
                Registrar Receta
            </button>

            @error('clienteId')
                <span class="text-red-600 text-sm mt-2 block">{{$message}}</span>
            @enderror

            <!-- Datos del Cliente (se muestran si existe un cliente) -->
            @if($clienteId)
                <div class="mt-4 space-y-3">
                    <label class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" class="w-full p-2 border rounded-md bg-gray-100" value="{{ $nombre }}" disabled>

                    <label class="block text-sm font-medium text-gray-700">Telefono</label>
                    <input type="text" class="w-full p-2 border rounded-md bg-gray-100" value="{{ $telefono }}" disabled>
                </div>
            @endif
        </div>

        <!-- Sección de Productos -->
        <div class="col-span-3 space-y-4">
            
            <!-- Tipos -->
            <div class="bg-white p-2 rounded-lg shadow-md">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                    @forelse ($tipos as $index => $item)
                        <div class="flex items-center rounded-lg shadow-lg cursor-pointer hover:scale-105 transition transform duration-200"
                            style="background-color: {{ ['#ffeb3b', '#ff9800', '#8bc34a', '#03a9f4', '#e91e63'][$index % 5] }};" 
                            wire:click="productosTipo({{ $item->id_tipo }})">
                            
                            <!-- Imagen a la izquierda -->
                            <img class="w-23 h-16 rounded-lg object-cover" src="/storage/img/{{ $item->foto }}" alt="{{ $item->nombre }}">
            
                            <!-- Texto a la derecha -->
                            <p class="text-white font-semibold text-lg ml-3">{{ $item->nombre }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500">No hay Categorías</p>
                    @endforelse
                </div>
            </div>
            
            <!-- Buscador de Productos -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Buscar Productos</h2>
                <div class="flex items-center space-x-4">
                    <input 
                        type="search" wire:model="searchProducto" wire:keydown.enter="clickBuscar()"
                        placeholder="Buscar Productos" 
                        class="w-full max-w-md px-4 py-2 text-sm border border-gray-300 rounded-md bg-gray-100 focus:ring-orange-500">
                    <button wire:click="clickBuscar()" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300">
                        Buscar
                    </button>
                </div>
            </div>

            <!-- Lista de productos -->
            <div class="bg-white grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 rounded-lg shadow-md">
                @forelse ($productos->where('stock', '>', 0) as $item)
                    <div class="flex items-center p-4 border border-gray-300 rounded-lg">
                        <!-- Imagen del producto -->
                        <div class="shrink-0 -ml-2"> 
                            <img class="w-24 h-24 rounded-lg object-cover" src="/storage/img/{{$item->foto}}" alt="Producto">
                        </div>

                        <!-- Información del producto -->
                        <div class="flex-1 min-w-0 ml-4">
                            <p class="text-sm font-medium text-black truncate">{{$item->nombre}}</p>
                            <p class="text-sm font-medium text-black truncate">Bs. {{$item->precioVenta}}</p>
                            <p class="text-sm text-gray-500 truncate">Disp.: {{$item->stock}}</p>
                        </div>

                        <!-- Botón agregar -->
                        <div>
                            <button wire:click="addProducto({{$item->id_producto}})" class="bg-green-600 w-10 h-10 rounded-full text-white">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">No hay Productos disponibles</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Sección Carrito -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <div class="bg-white p-4 rounded-lg shadow-md col-span-2">
            <h2 class="text-xl font-semibold mb-4 text-center">Carrito de Compras</h2>
            @error('carrito') <span class="text-red-500">{{ $message }}</span> @enderror
            @forelse ($carrito as $item)
                <div class="flex justify-between items-center border-b pb-4">
                    <img src="/storage/img/{{$item['producto']['foto']}}" alt="" class="w-16 h-16 rounded-lg">
                    <p class="flex-1 text-center">{{$item['producto']['nombre']}}</p>
                    <p class="flex-1 text-center">Bs. {{$item['precioVenta']}}</p>
                    <input disabled type="number" step="1" value="{{$item['cantidad']}}" class="w-20 text-center border rounded-md bg-gray-100">
                    <div class="flex space-x-2">
                        <button wire:click="addProducto({{$item['producto']['id_producto']}})" class="bg-green-600 w-10 h-10 rounded-full text-white">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button wire:click="removeProducto({{$item['producto']['id_producto']}})" class="bg-red-600 w-10 h-10 rounded-full text-white">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">No hay productos en el carrito.</p>
            @endforelse
        </div>

        <!-- Sección de Pago -->
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Total: Bs. {{$total}}</h2>

            <!-- Selección del tipo de pago -->
            <label class="block text-sm font-medium text-gray-700">Tipo de Pago</label>
            <select wire:model="id_pago" class="w-full p-2 border rounded-md mb-4 text-sm">
                <option value="">Selecciona método de pago</option>
                @foreach ($tiposPago as $pago)
                    <option value="{{ $pago->id_pago }}">{{ $pago->nombre }}</option>
                @endforeach
            </select>
            @error('id_pago')
                <span class="text-red-600 text-sm">{{$message}}</span>
            @enderror

            <input type="hidden" wire:model="tipoPagoId">

            <button wire:click="guardar()" class="bg-blue-600 text-white w-full py-2 rounded-md hover:bg-blue-700 transition duration-300">Realizar Venta</button>
        </div>
    </div>
    @if($showModal)
        @include('livewire.modalFactura')
    @endif
    @if($showModalReceta)
        @include('livewire.modalReceta')
    @endif

    <script>
        window.addEventListener('alerta-controlado', event => {
            alert(event.detail.message);
            // También podrías usar SweetAlert o Toast si prefieres
            // Swal.fire({ icon: 'warning', title: 'Atención', text: event.detail.message });
        });
    </script>

</div>
