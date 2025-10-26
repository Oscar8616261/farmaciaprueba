<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoModel extends Model
{
    protected $table = 'producto';
    protected $fillable = ['nombre','foto','id_tipo','precioCompra','precioVenta','descuento','stock','stockMinimo','estado','fechaVencimiento','controlado','id_proveedor','id_presentacion'];
    protected $primaryKey = 'id_producto';


    public function tipo()
    {
        return $this->belongsTo(TipoModel::class, 'id_tipo', 'id_tipo');
    }

    public function proveedor()
    {
        return $this->belongsTo(ProveedorModel::class, 'id_proveedor', 'id_proveedor');
    }
    public function presentacion()
    {
        return $this->belongsTo(PresentacionModel::class, 'id_presentacion', 'id_presentacion');
    }
}
