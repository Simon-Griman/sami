<?php

namespace App\Http\Controllers;

use App\Models\Consolidado;

class ConsolidadoController extends Controller
{
    public function index()
    {
        return view('consolidado.index');
    }

    public function create()
    {
        return view('consolidado.create');
    }

    public function edit($id)
    {
        $consolidado = Consolidado::find($id);

        return view('consolidado.edit', compact('consolidado'));
    }
}
