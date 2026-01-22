<?php

namespace App\Http\Controllers;

use App\Models\Consolidado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $name = Auth::user()->name;

        return view('index', compact('name'));
    }
}
