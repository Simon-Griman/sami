<?php

namespace App\Http\Controllers;

use App\Models\UserLogin;
use Illuminate\Http\Request;

class UserLoginController extends Controller
{
    public function __invoke()
    {
        return view('auditoria.sesiones');
    }
}
