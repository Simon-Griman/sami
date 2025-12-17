<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrosCreadosController extends Controller
{
    public function __invoke()
    {
        return view('auditoria.registros_creados');
    }
}
