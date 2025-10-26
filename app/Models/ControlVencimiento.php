<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ControlVencimiento extends Model
{
    protected $table = 'control_vencimientos';
    protected $fillable = ['producto_id', 'fecha_vencimiento', 'dias_alerta'];
    protected $primaryKey = 'id_control_vencimiento';
}
