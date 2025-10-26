<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\TipoModel;
use App\Models\PresentacionModel;

class Categoria extends Component
{
    use WithFileUploads;
    public $showModalTipos = false;
    public $showModalPresentacion = false;
    
    public $nombre = '';
    public $foto;
    public $tipo_id ='';

    public $tipoPresentacion = '';
    public $codigo = '';
    public $presentacion_id ='';

    public function rulesTipo(){
        $rules = [
            'nombre' => 'required|string|max:255',
        ];
        if (($this->tipo_id && is_object($this->foto)) ){
            $rules['foto']=['image','max:10024'];
        }
        else if($this->tipo_id=='')
            $rules['foto']=['image','max:10024'];
        return $rules;
    }

    public function rulesPresentacion(){
        $rules = [
            'tipoPresentacion' => 'required|string|max:255',
            'codigo' => 'required|string|max:255',
        ];
        return $rules;
    }

    public function render()
    {
        $tipos = TipoModel::all();
        $presentaciones = PresentacionModel::all();
        return view('livewire.categoria', compact('tipos', 'presentaciones'));
    }
    public function openModalTipos()
    {
        $this->showModalTipos = true;
    }
    
    public function closeModalTipos()
    {
        $this->showModalTipos = false;
       $this->limpiarDatosTipos();
    }
    public function limpiarDatosTipos(){
        $this->nombre='';
        $this->foto=null;
    }
    public function enviarClickTipo()
    {
        $this->validate($this->rulesTipo());
        if ($this->tipo_id) {
            $tipo = TipoModel::find($this->tipo_id);
            $tipo->nombre = $this->nombre;
            if ($this->foto && is_object($this->foto)) {
                $filename = time() . '_' . $this->foto->getClientOriginalName();
                $this->foto->storeAs('img', $filename, 'public');
                $tipo->foto = $filename;
            }
            $tipo->save();
            $this->tipo_id='';
        } else {
            $filename = time() . '_' . $this->foto->getClientOriginalName();
            $this->foto->storeAs('img', $filename, 'public');
            TipoModel::create([
                'nombre' => $this->nombre,
                'foto' => $filename,
            ]);
        }
        $this->closeModalTipos();
        $this->limpiarDatosTipos();
    }
    public function editarTipo($id)
    {
        $tipo = TipoModel::find($id);
        $this->nombre = $tipo->nombre;
        if (!$this->foto) {
            $this->foto = $tipo->foto;
        }

        $this->tipo_id = $id;
        $this->openModalTipos();
    }

    public function openModalPresentacion()
    {
        $this->showModalPresentacion = true;
    }
    
    public function closeModalPresentacion()
    {
        $this->showModalPresentacion = false;
       $this->limpiarDatosPresentacion();
    }
    public function limpiarDatosPresentacion(){
        $this->tipoPresentacion='';
        $this->codigo='';
    }
    public function enviarClickPresentacion()
    {
        $this->validate($this->rulesPresentacion());
        if ($this->presentacion_id) {
            $presentacion = PresentacionModel::find($this->presentacion_id);
            $presentacion->tipoPresentacion = $this->tipoPresentacion;
            $presentacion->codigo = $this->codigo;
            $presentacion->save();
            $this->presentacion_id='';
        } else {
            PresentacionModel::create([
                'tipoPresentacion' => $this->tipoPresentacion,
                'codigo' => $this->codigo,
            ]);
        }
        $this->closeModalPresentacion();
        $this->limpiarDatosPresentacion();
    }
    public function editarPresentacion($id)
    {
        $presentacion = PresentacionModel::find($id);
        $this->tipoPresentacion = $presentacion->tipoPresentacion;
        $this->codigo = $presentacion->codigo;

        $this->presentacion_id = $id;
        $this->openModalPresentacion();
    }
}
