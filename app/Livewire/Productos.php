<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ProductoModel;
use App\Models\PresentacionModel;
use App\Models\ProveedorModel;
use App\Models\TipoModel;

class Productos extends Component
{

    use WithFileUploads;
    public $search='';
    public $showModal=false;


    public $nombre='';
    public $foto;
    public $tipo='';
    public $precioCompra='';
    public $precioVenta='';
    public $descuento='';
    public $stock='';
    public $stockMinimo='';
    public $estado='';
    public $fechaVencimiento='';
    public $controlado='';
    public $proveedor='';
    public $presentacion='';
    public $producto_id='';

    public function rules(){
        $rules = [
            'nombre' => 'required|string|max:255',
            'tipo' => 'required',
            'precioVenta' => 'required|numeric',
            'precioCompra' => 'required|numeric',
            'stockMinimo' => 'required|integer|min:1',
            'controlado' => 'required|in:si,no',
        ];
        if (($this->producto_id && is_object($this->foto)) ){
            $rules['foto']=['image','max:10024'];
        }
        else if($this->producto_id=='')
            $rules['foto']=['image','max:10024'];
        return $rules;
    }

    public function render()
    {
        $presentaciones=PresentacionModel::all();
        $proveedores=ProveedorModel::all();
        $tipos=TipoModel::all();
        $productos = ProductoModel::where('nombre', 'like', '%' . $this->search . '%')->get();
        return view('livewire.productos', compact('presentaciones', 'proveedores', 'productos', 'tipos'));
    }
    public function clickBuscar(){

    }
    public function openModal(){
        $this->showModal=true;
    }
    public function closeModal(){
        $this->showModal=false;
        $this->limpiarDatos();
    }
    public function limpiarDatos(){
        $this->nombre='';
        $this->foto=null;
        $this->tipo='';
        $this->precioCompra='';
        $this->precioVenta='';
        $this->descuento='';
        $this->stock='';
        $this->stockMinimo='';
        $this->estado='';
        $this->fechaVencimiento='';
        $this->controlado='';
        $this->proveedor='';
        $this->presentacion='';
        $this->producto_id='';
    }

    public function enviarClick()
    {
        $this->validate();
        if ($this->producto_id) {
            $producto = ProductoModel::find($this->producto_id);
            $producto->nombre = $this->nombre;
            $producto->id_tipo = $this->tipo;
            $producto->precioCompra = $this->precioCompra;
            $producto->precioVenta = $this->precioVenta;
            $producto->stockMinimo = intval($this->stockMinimo);
            $producto->fechaVencimiento = $this->fechaVencimiento ?: null;
            $producto->controlado = $this->controlado;
            $producto->id_proveedor = $this->proveedor ?: null;
            $producto->id_presentacion = $this->presentacion ?: null;
            if ($this->foto && is_object($this->foto)) {
                $filename = time() . '_' . $this->foto->getClientOriginalName();
                $this->foto->storeAs('img', $filename, 'public');
                $producto->foto = $filename;
            }
            $producto->save();
            $this->producto_id='';
        } else {
            $filename = time() . '_' . $this->foto->getClientOriginalName();
            $this->foto->storeAs('img', $filename, 'public');

            ProductoModel::create([
                'nombre' => $this->nombre,
                'foto' => $filename,
                'id_tipo' => $this->tipo,
                'precioCompra' => $this->precioCompra,
                'precioVenta' => $this->precioVenta,
                'descuento' => 0,
                'stock' => 0,
                'stockMinimo' => intval($this->stockMinimo),
                'estado' => 'activo',
                'fechaVencimiento' => $this->fechaVencimiento ?: null,
                'controlado' => $this->controlado,
                'id_proveedor' => $this->proveedor ?: null,
                'id_presentacion' => $this->presentacion ?: null,
            ]);
        }
        $this->limpiarDatos();
        $this->closeModal();
    }
    public function editar($id){
        $producto = ProductoModel::find($id);
        $this->nombre = $producto->nombre;
        $this->tipo = $producto->id_tipo;
        $this->precioCompra = $producto->precioCompra;
        $this->precioVenta = $producto->precioVenta;
        $this->stockMinimo = $producto->stockMinimo;
        $this->fechaVencimiento = $producto->fechaVencimiento;
        $this->controlado = $producto->controlado;
        $this->proveedor = $producto->id_proveedor;
        $this->presentacion = $producto->id_presentacion;
        if (!$this->foto) {
            $this->foto = $producto->foto;
        }
        
        $this->producto_id = $id;
        $this->openModal();
    }
    public function delete($id){
        $producto = ProductoModel::find($id);
        if ($producto) {
            $producto->estado = 'inactivo';
            $producto->save();
        }
    }
    public function activar($id){
        $producto = ProductoModel::find($id);
        if ($producto) {
            $producto->estado = 'activo';
            $producto->save();
        }
    }
}
