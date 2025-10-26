<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CambioController extends Controller
{
    public function index(){
        return view('cambios.index');
    }
}
