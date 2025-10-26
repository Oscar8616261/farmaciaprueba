<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cambio;
use App\Models\Pedido;
use App\Models\ProductoModel;

class Cambio extends Component
{
    public $search = '';
    public $showModal = false;

    public $pedido_id = '';
    public $producto_id = '';
    public $cantidad = '';
    public $motivo = '';
    public $cambio_id ='';

    public function rules(){
        $rules = [
            'pedido_id' => 'required|exists:pedidos,id_pedido',
            'producto_id' => 'required|exists:producto,id_producto',
            'cantidad' => 'required|numeric|min:1',
            'motivo' => 'required|string|max:255',
        ];
        return $rules;
    }

    public function render()
    {
        $cambios = Cambio::where('id_cambio', 'like', '%'.$this->search.'%')
            ->get();
        $pedidos = Pedido::all();
        $productos = ProductoModel::all();
        return view('livewire.cambio', compact('cambios', 'pedidos', 'productos'));
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
        $this->pedido_id='';
        $this->producto_id='';
        $this->cantidad='';
        $this->motivo='';
    }
    public function enviarClick()
    {
        $this->validate();

        if ($this->cambio_id) {
            $cambio = Cambio::find($this->cambio_id);
            $cambio->pedido_id = $this->pedido_id;
            $cambio->producto_id = $this->producto_id;
            $cambio->cantidad = $this->cantidad;
            $cambio->motivo = $this->motivo;
            $cambio->save();
        } else {
            Cambio::create([
                'pedido_id' => $this->pedido_id,
                'producto_id' => $this->producto_id,
                'cantidad' => $this->cantidad,
                'motivo' => $this->motivo,
            ]);
        }
        $this->limpiarDatos();
        $this->closeModal();
    }
    public function editar($id){
        $cambio = Cambio::findOrFail($id);
        $this->pedido_id = $cambio->pedido_id;
        $this->producto_id = $cambio->producto_id;
        $this->cantidad = $cambio->cantidad;
        $this->motivo = $cambio->motivo;
        $this->cambio_id = $id;
        $this->openModal();
    }
}
