<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Alerta;

class Alerta extends Component
{
    public $search = '';
    public $showModal = false;

    public $tipo_alerta = '';
    public $mensaje = '';
    public $leida = '';
    public $alerta_id ='';

    public function rules(){
        $rules = [
            'tipo_alerta' => 'required|string|max:255',
            'mensaje' => 'required|string',
            'leida' => 'boolean',
        ];
        return $rules;
    }

    public function render()
    {
        $alertas = Alerta::where('id_alerta', 'like', '%'.$this->search.'%')
            ->get();
        return view('livewire.alerta', compact('alertas'));
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
        $this->tipo_alerta='';
        $this->mensaje='';
        $this->leida='';
    }
    public function enviarClick()
    {
        $this->validate();

        if ($this->alerta_id) {
            $alerta = Alerta::find($this->alerta_id);
            $alerta->tipo_alerta = $this->tipo_alerta;
            $alerta->mensaje = $this->mensaje;
            $alerta->leida = $this->leida;
            $alerta->save();
        } else {
            Alerta::create([
                'tipo_alerta' => $this->tipo_alerta,
                'mensaje' => $this->mensaje,
                'leida' => $this->leida,
            ]);
        }
        $this->limpiarDatos();
        $this->closeModal();
    }
    public function editar($id){
        $alerta = Alerta::findOrFail($id);
        $this->tipo_alerta = $alerta->tipo_alerta;
        $this->mensaje = $alerta->mensaje;
        $this->leida = $alerta->leida;
        $this->alerta_id = $id;
        $this->openModal();
    }
}
