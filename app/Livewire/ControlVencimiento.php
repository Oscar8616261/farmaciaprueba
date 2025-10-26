<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ControlVencimiento;
use App\Models\ProductoModel;

class ControlVencimiento extends Component
{
    public $search = '';
    public $showModal = false;

    public $producto_id = '';
    public $fecha_vencimiento = '';
    public $dias_alerta = '';
    public $control_vencimiento_id ='';

    public function rules(){
        $rules = [
            'producto_id' => 'required|exists:producto,id_producto',
            'fecha_vencimiento' => 'required|date',
            'dias_alerta' => 'required|numeric|min:1',
        ];
        return $rules;
    }

    public function render()
    {
        $control_vencimientos = ControlVencimiento::where('id_control_vencimiento', 'like', '%'.$this->search.'%')
            ->get();
        $productos = ProductoModel::all();
        return view('livewire.control-vencimiento', compact('control_vencimientos', 'productos'));
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
        $this->producto_id='';
        $this->fecha_vencimiento='';
        $this->dias_alerta='';
    }
    public function enviarClick()
    {
        $this->validate();

        if ($this->control_vencimiento_id) {
            $control_vencimiento = ControlVencimiento::find($this->control_vencimiento_id);
            $control_vencimiento->producto_id = $this->producto_id;
            $control_vencimiento->fecha_vencimiento = $this->fecha_vencimiento;
            $control_vencimiento->dias_alerta = $this->dias_alerta;
            $control_vencimiento->save();
        } else {
            ControlVencimiento::create([
                'producto_id' => $this->producto_id,
                'fecha_vencimiento' => $this->fecha_vencimiento,
                'dias_alerta' => $this->dias_alerta,
            ]);
        }
        $this->limpiarDatos();
        $this->closeModal();
    }
    public function editar($id){
        $control_vencimiento = ControlVencimiento::findOrFail($id);
        $this->producto_id = $control_vencimiento->producto_id;
        $this->fecha_vencimiento = $control_vencimiento->fecha_vencimiento;
        $this->dias_alerta = $control_vencimiento->dias_alerta;
        $this->control_vencimiento_id = $id;
        $this->openModal();
    }
}
