<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrosEditadosController extends Controller
{
    public function __invoke()
    {
        return view('auditoria.registros_editados');
    }
}
