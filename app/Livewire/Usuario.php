<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UsuarioModel;

class Usuario extends Component
{
    public $search = '';
    public $showModal = false;
    
    public $nombre = '';
    public $telefono = '';
    public $turno = '';
    public $usuario = '';
    public $contrasena = '';
    public $contrasena1 = '';
    public $rol = '';
    public $usuario_id ='';

    public function rules(){
        $rules = [
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'turno' => 'required|string|max:255',
            'usuario' => 'required|string|max:255',
            'contrasena' => 'required|string|min:6',
            'contrasena1' => 'required|string|same:contrasena',
            'rol' => 'required|in:administrador,personal',
        ];
        return $rules;
    }

    public function render()
    {
        $usuarios = UsuarioModel::where('nombre', 'like', '%'.$this->search.'%')
            ->get();
        return view('livewire.usuario', compact('usuarios'));
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
        $this->usuario='';
        $this->contrasena='';
        $this->contrasena1='';
        $this->rol='';
        $this->turno='';
    }

    public function enviarClick()
    {
        $this->validate();
        if ($this->usuario_id) {
            $usuario = UsuarioModel::find($this->usuario_id);
            $usuario->nombre = $this->nombre;
            $usuario->telefono = $this->telefono;
            $usuario->turno = $this->turno;
            $usuario->usuario = $this->usuario;
            $usuario->contrasena = $this->contrasena;
            $usuario->rol = $this->rol;
            $usuario->save();
            $this->usuario_id='';
        } else {
            UsuarioModel::create([
                'nombre' => $this->nombre,
                'telefono' => $this->telefono,
                'turno' => $this->turno,
                'usuario' => $this->usuario,
                'contrasena' => $this->contrasena,
                'rol' => $this->rol,
            ]);
        }
        $this->limpiarDatos();
        $this->closeModal();
    }

    public function editar($id){
        $usuario = UsuarioModel::findOrFail($id);
        $this->nombre = $usuario->nombre;
        $this->telefono = $usuario->telefono;
        $this->turno = $usuario->turno;
        $this->usuario = $usuario->usuario;
        $this->contrasena = $usuario->contrasena;
        $this->contrasena1 = $usuario->contrasena;
        $this->rol = $usuario->rol;

        $this->usuario_id = $id;
        $this->openModal();
    }    
}
