<div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white p-8 rounded-lg shadow-xl max-w-4xl w-full border border-gray-300">
        <!-- Encabezado -->
        <div class="flex items-center justify-between mb-6">
            <img src="/img/logo.png" alt="Logo" class="w-24 h-24">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-800">LimberthPool</h2>
            </div>
        </div>

        <!-- Detalles de la Venta -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="text-left text-gray-800">
                <p class="font-medium">Venta N°: <span class="font-normal">{{ $idVenta }}</span></p>
                <p class="font-medium">Fecha: <span class="font-normal">{{ \Carbon\Carbon::now('America/La_Paz')->format('d/m/Y') }}</span></p>
            </div>
        </div>

        <!-- Tabla de productos -->
        <h3 class="text-lg font-semibold mb-4 border-b pb-2">Detalles de la Venta</h3>
        <div class="overflow-x-auto mb-6">
            <table class="w-full table-auto border-collapse border border-gray-300 text-sm">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left">Producto</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Cantidad</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">Precio</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($carrito as $item)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $item['producto']['nombre'] }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $item['cantidad'] }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">Bs. {{ $item['precioVenta'] }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">Bs. {{ $item['precioVenta'] * $item['cantidad'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-500">No hay productos en el carrito</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Totales -->
        <div class="text-right text-gray-800 mb-6">
            <div class="flex justify-between text-lg font-semibold">
                <p>Total:</p>
                <p>Bs. {{ $total }}</p>
            </div>
        </div>

        <!-- Método de pago -->
        <div class="flex justify-between text-lg font-medium mb-6">
            <p>Método de Pago:</p>
            <p>{{ $tipoPago }}</p>
        </div>

        <!-- Pie de factura -->
        <div class="text-center text-sm text-gray-600 mt-4">
            <p>Gracias por su compra. ¡Vuelva pronto!</p>
        </div>
        <style>
            @media print {
                .hidden-print {
                    display: none !important;
                }
            }
        </style>
        <!-- Botones -->
        <div class="mt-6 flex justify-between hidden-print">
            <button onclick="window.print()" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-300">
                <i class="fas fa-print"></i> Imprimir
            </button>
            <button wire:click="closeModal" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                Cerrar
            </button>
        </div>
    </div>
</div>