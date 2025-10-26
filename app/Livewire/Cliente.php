<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ClienteModel;

class Cliente extends Component
{
    public $search = '';
    public $showModal = false;
    
    public $nombre = '';
    public $telefono = '';
    public $ci = '';
    public $direccion = '';
    public $cliente_id ='';

    public function rules(){
        $rules = [
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'ci' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
        ];
        return $rules;
    }

    public function render()
    {
        $clientes = ClienteModel::where('nombre', 'like', '%'.$this->search.'%')
            ->get();
        return view('livewire.cliente', compact('clientes'));
    }
    public function clickBuscar(){

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
        $this->nombre='';
        $this->telefono='';
        $this->ci='';
        $this->direccion='';
    }
    public function enviarClick()
    {
        $this->validate();

        if ($this->cliente_id) {
            $cliente = ClienteModel::find($this->cliente_id);
            $cliente->nombre = $this->nombre;
            $cliente->telefono = $this->telefono;
            $cliente->ci = $this->ci;
            $cliente->direccion = $this->direccion;
            $cliente->save();
        } else {
            ClienteModel::create([
                'nombre' => $this->nombre,
                'telefono' => $this->telefono,
                'ci' => $this->ci,
                'direccion' => $this->direccion,
            ]);
        }
        $this->limpiarDatos();
        $this->closeModal();
    }
    public function editar($id){
        $cliente = ClienteModel::findOrFail($id);
        $this->nombre = $cliente->nombre;
        $this->telefono = $cliente->telefono;
        $this->ci = $cliente->ci;
        $this->direccion = $cliente->direccion;
        $this->cliente_id = $id;
        $this->openModal();
    }
}
