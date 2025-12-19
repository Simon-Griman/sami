<?php

namespace App\Http\Controllers;

class UserLoginController extends Controller
{
    public function __invoke()
    {
        return view('auditoria.sesiones');
    }
}
