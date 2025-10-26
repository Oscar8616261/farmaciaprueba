<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedido;
use App\Models\ProveedorModel;
use App\Models\ProductoModel;

class Pedido extends Component
{
    public $search = '';
    public $showModal = false;

    public $proveedor_id = '';
    public $producto_id = '';
    public $cantidad = '';
    public $estado = '';
    public $pedido_id ='';

    public function rules(){
        $rules = [
            'proveedor_id' => 'required|exists:proveedor,id_proveedor',
            'producto_id' => 'required|exists:producto,id_producto',
            'cantidad' => 'required|numeric|min:1',
            'estado' => 'required|string|max:255',
        ];
        return $rules;
    }

    public function render()
    {
        $pedidos = Pedido::where('id_pedido', 'like', '%'.$this->search.'%')
            ->get();
        $proveedores = ProveedorModel::all();
        $productos = ProductoModel::all();
        return view('livewire.pedido', compact('pedidos', 'proveedores', 'productos'));
    }

    public function openModal()
    {
        $this->showModal = true;
    }
    public function closeModal()
    {
        $this->showModal = false;
       $this->limpiarDatos();
    }
    public function limpiarDatos(){
        $this->proveedor_id='';
        $this->producto_id='';
        $this->cantidad='';
        $this->estado='';
    }
    public function enviarClick()
    {
        $this->validate();

        if ($this->pedido_id) {
            $pedido = Pedido::find($this->pedido_id);
            $pedido->proveedor_id = $this->proveedor_id;
            $pedido->producto_id = $this->producto_id;
            $pedido->cantidad = $this->cantidad;
            $pedido->estado = $this->estado;
            $pedido->save();
        } else {
            Pedido::create([
                'proveedor_id' => $this->proveedor_id,
                'producto_id' => $this->producto_id,
                'cantidad' => $this->cantidad,
                'estado' => $this->estado,
            ]);
        }
        $this->limpiarDatos();
        $this->closeModal();
    }
    public function editar($id){
        $pedido = Pedido::findOrFail($id);
        $this->proveedor_id = $pedido->proveedor_id;
        $this->producto_id = $pedido->producto_id;
        $this->cantidad = $pedido->cantidad;
        $this->estado = $pedido->estado;
        $this->pedido_id = $id;
        $this->openModal();
    }
}
