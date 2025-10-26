<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVentaModel extends Model
{
    protected $table = 'detalle_venta';
    protected $fillable = ['id_venta','id_producto','precio_unitario','cantidad','subtotal'];
    protected $primaryKey = 'id_detalle';

    public function venta()
    {
        return $this->belongsTo(VentaModel::class, 'id_venta', 'id_venta');
    }
    public function producto()
    {
        return $this->belongsTo(ProductoModel::class, 'id_producto', 'id_producto');
    }
}
