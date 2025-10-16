<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsolidadoController extends Controller
{
    public function index()
    {
        return view('consolidado.index');
    }

    public function create()
    {
        return 'create';
    }

    public function edit()
    {
        return 'edit';
    }
}
