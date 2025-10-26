<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\DevolucionModel; // si no existe, se usa la tabla 'devolucion' con Model base
use App\Models\DetalleDevolucionModel;
use App\Models\ProveedorModel;
use App\Models\ProductoModel;
use Illuminate\Support\Facades\DB;

class Cambios extends Component
{
    public $showModal = false;
    public $fecha;
    public $motivo = '';
    public $proveedor = '';
    public $items = []; // items para devolver: id_producto, cantidad, precio_unitario, subtotal

    public function mount()
    {
        $this->fecha = now()->toDateString();
    }

    public function render()
    {
        $proveedores = ProveedorModel::all();
        $productos = ProductoModel::where('estado', 'activo')->get();
        // devoluciones: usaremos la tabla 'devolucion' ya creada (modelo no incluido por defecto)
        $devoluciones = DB::table('devolucion')->orderBy('id_devolucion', 'desc')->get();

        return view('livewire.cambios', compact('proveedores', 'productos', 'devoluciones'));
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function resetForm()
    {
        $this->fecha = now()->toDateString();
        $this->motivo = '';
        $this->proveedor = '';
        $this->items = [];
    }

    public function agregarProducto($id_producto)
    {
        $prod = ProductoModel::find($id_producto);
        if (!$prod) return;
        foreach ($this->items as &$it) {
            if ($it['id_producto'] == $prod->id_producto) {
                $it['cantidad']++;
                $it['subtotal'] = $it['cantidad'] * $it['precio_unitario'];
                return;
            }
        }
        $this->items[] = [
            'id_producto' => $prod->id_producto,
            'nombre' => $prod->nombre,
            'precio_unitario' => floatval($prod->precioCompra),
            'cantidad' => 1,
            'subtotal' => floatval($prod->precioCompra)
        ];
    }

    public function guardarCambio()
    {
        $this->validate([
            'proveedor' => 'required',
            'motivo' => 'required|string|max:255',
            'items' => 'required|array|min:1'
        ]);

        // Verifica reglas del proveedor
        $prov = ProveedorModel::find($this->proveedor);
        if (!$prov) {
            session()->flash('error', 'Proveedor no válido.');
            return;
        }

        // Si proveedor es "sin proveedor" no se permiten cambios (según tu requerimiento)
        if ($prov->nombre === 'sin proveedor') {
            session()->flash('error', 'Los productos del proveedor "sin proveedor" no pueden generar devoluciones; solo pueden ir a promociones.');
            return;
        }

        // Validar días antes de vencimiento: cada item debe cumplir la regla
        foreach ($this->items as $it) {
            $producto = ProductoModel::find($it['id_producto']);
            if (!$producto) continue;
            if ($producto->fechaVencimiento) {
                $fechaVenc = \Carbon\Carbon::parse($producto->fechaVencimiento);
                $diasRestantes = now()->diffInDays($fechaVenc, false); // negativo si ya vencido
                if ($prov->diasCambioAntesVencimiento > 0 && $diasRestantes > $prov->diasCambioAntesVencimiento) {
                    // Si faltan más días que el requisito, entonces todavía no aplica el cambio
                    session()->flash('error', "El producto {$producto->nombre} no cumple el requisito de aviso ({$prov->diasCambioAntesVencimiento} días).");
                    return;
                }
            } else {
                // si no tiene fecha de vencimiento, permitimos el cambio (o se puede bloquear según regla)
            }
        }

        // Guardar devolucion
        DB::transaction(function () {
            $devolId = DB::table('devolucion')->insertGetId([
                'fecha' => $this->fecha,
                'motivo' => $this->motivo,
                'id_proveedor' => $this->proveedor,
                'estado' => 'pendiente',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($this->items as $it) {
                DB::table('detalle_devolucion')->insert([
                    'id_devolucion' => $devolId,
                    'id_producto' => $it['id_producto'],
                    'precio_unitario' => $it['precio_unitario'],
                    'cantidad' => $it['cantidad'],
                    'subtotal' => $it['subtotal'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

        session()->flash('message', 'Devolución registrada correctamente.');
        $this->resetForm();
        $this->showModal = false;
    }
}
