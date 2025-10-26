<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresentacionModel extends Model
{
    protected $table = 'presentacion';
    protected $fillable = ['tipoPresentacion','codigo'];
    protected $primaryKey = 'id_presentacion';
}
