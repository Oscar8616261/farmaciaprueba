<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProveedorModel extends Model
{
    protected $table = 'proveedor';
    protected $fillable = ['nombre','tipo','telefono','diasCambioAntesVencimiento'];
    protected $primaryKey = 'id_proveedor';
}
