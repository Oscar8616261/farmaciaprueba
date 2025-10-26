<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class UsuarioModel extends Authenticatable
{
    use Notifiable;
    protected $table = 'usuario';
    protected $fillable = ['nombre', 'telefono', 'turno', 'usuario', 'contrasena', 'rol'];
    protected $primaryKey = 'id_usuario';
    public function isUsuario()
    {
        return true;
    }
}
