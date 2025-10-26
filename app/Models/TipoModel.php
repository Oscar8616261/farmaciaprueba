<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoModel extends Model
{
    protected $table = 'tipo';
    protected $fillable = ['nombre','foto'];
    protected $primaryKey = 'id_tipo';
}
