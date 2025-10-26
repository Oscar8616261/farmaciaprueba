<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = ['proveedor_id', 'producto_id', 'cantidad', 'estado'];
    protected $primaryKey = 'id_pedido';
}
