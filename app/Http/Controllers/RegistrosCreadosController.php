<?php

namespace App\Http\Controllers;

class RegistrosCreadosController extends Controller
{
    public function __invoke()
    {
        return view('auditoria.registros_creados');
    }
}
