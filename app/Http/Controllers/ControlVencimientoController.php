<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControlVencimientoController extends Controller
{
    public function index(){
        return view('control_vencimientos.index');
    }
}
