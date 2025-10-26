<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecetaModel extends Model
{
    protected $table = 'receta';
    protected $fillable = ['fechaEmision','nombreDoctor','diagnostico'];
    protected $primaryKey = 'id_receta';
}
