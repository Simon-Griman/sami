<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SegregacionController extends Controller
{
    public function __invoke()
    {
        return view('segregacion');
    }
}
