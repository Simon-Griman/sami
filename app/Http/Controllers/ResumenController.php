<?php

namespace App\Http\Controllers;

use App\Models\Consolidado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResumenController extends Controller
{
    public function __invoke()
    {
        return view('resumen');
    }
}
