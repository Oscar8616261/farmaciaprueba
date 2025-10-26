<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PedidoModel;
use App\Models\DetallePedidoModel;
use App\Models\ProveedorModel;
use App\Models\ProductoModel;
use Illuminate\Support\Facades\DB;

class Pedidos extends Component
{
    public $showModal = false;
    public $fecha;
    public $proveedor = '';
    public $productosSeleccion = []; // [id_producto => cantidad]
    public $items = []; // detalle temporal con precio y cantidad
    public $total = 0;

    public function mount()
    {
        $this->fecha = now()->toDateString();
    }

    public function render()
    {
        $proveedores = ProveedorModel::all();
        $pedidos = PedidoModel::with('proveedor')->orderBy('id_pedido', 'desc')->get();
        $productos = ProductoModel::where('estado', 'activo')->get();

        return view('livewire.pedidos', compact('proveedores', 'pedidos', 'productos'));
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function resetForm()
    {
        $this->fecha = now()->toDateString();
        $this->proveedor = '';
        $this->items = [];
        $this->total = 0;
    }

    public function agregarProducto($id_producto)
    {
        $producto = ProductoModel::find($id_producto);
        if (!$producto) return;
        // si ya existe, aumentar cantidad
        foreach ($this->items as &$it) {
            if ($it['id_producto'] == $producto->id_producto) {
                $it['cantidad']++;
                $it['subtotal'] = $it['cantidad'] * $it['precio_unitario'];
                $this->recalcularTotal();
                return;
            }
        }
        $this->items[] = [
            'id_producto' => $producto->id_producto,
            'nombre' => $producto->nombre,
            'precio_unitario' => floatval($producto->precioCompra),
            'cantidad' => 1,
            'subtotal' => floatval($producto->precioCompra)
        ];
        $this->recalcularTotal();
    }

    public function actualizarCantidad($index, $valor)
    {
        if (!isset($this->items[$index])) return;
        $cantidad = intval($valor) > 0 ? intval($valor) : 1;
        $this->items[$index]['cantidad'] = $cantidad;
        $this->items[$index]['subtotal'] = $cantidad * $this->items[$index]['precio_unitario'];
        $this->recalcularTotal();
    }

    public function eliminarItem($index)
    {
        array_splice($this->items, $index, 1);
        $this->recalcularTotal();
    }

    private function recalcularTotal()
    {
        $this->total = 0;
        foreach ($this->items as $it) {
            $this->total += floatval($it['subtotal']);
        }
    }

    public function guardarPedido()
    {
        $this->validate([
            'proveedor' => 'required',
            'items' => 'required|array|min:1',
        ], [
            'proveedor.required' => 'Seleccione un proveedor.',
            'items.required' => 'Agregue al menos un producto al pedido.'
        ]);

        DB::transaction(function () {
            $pedido = PedidoModel::create([
                'fecha' => $this->fecha,
                'total' => $this->total,
                'id_proveedor' => $this->proveedor,
                'estado' => 'pendiente'
            ]);

            foreach ($this->items as $it) {
                DetallePedidoModel::create([
                    'id_pedido' => $pedido->id_pedido,
                    'id_producto' => $it['id_producto'],
                    'precio_unitario' => $it['precio_unitario'],
                    'cantidad' => $it['cantidad'],
                    'subtotal' => $it['subtotal']
                ]);
            }
        });

        session()->flash('message', 'Pedido creado correctamente.');
        $this->resetForm();
        $this->showModal = false;
    }

    public function marcarRecibido($id_pedido)
    {
        $pedido = PedidoModel::find($id_pedido);
        if (!$pedido) return;
        $pedido->estado = 'recibido';
        $pedido->save();

        // Opcional: actualizar stock en productos según detalle
        foreach ($pedido->detalles as $det) {
            $prod = $det->producto;
            if ($prod) {
                $prod->stock = $prod->stock + intval($det->cantidad);
                $prod->save();
            }
        }

        session()->flash('message', 'Pedido marcado como recibido.');
    }
}
