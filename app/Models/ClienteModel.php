<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteModel extends Model
{
    protected $table = 'cliente';
    protected $fillable = ['nombre','telefono','ci','direccion'];
    protected $primaryKey = 'id_cliente';
}
