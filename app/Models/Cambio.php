<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cambio extends Model
{
    protected $table = 'cambios';
    protected $fillable = ['pedido_id', 'producto_id', 'cantidad', 'motivo'];
    protected $primaryKey = 'id_cambio';
}
