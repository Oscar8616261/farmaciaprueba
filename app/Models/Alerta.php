<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    protected $table = 'alertas';
    protected $fillable = ['tipo_alerta', 'mensaje', 'leida'];
    protected $primaryKey = 'id_alerta';
}
