<?php

namespace App\Http\Livewire\Auditoria;

use App\Models\User;
use App\Models\UserLogin;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Sesion extends Component
{
    public $usuario, $log_usuario = [], $name;

    public function registros($id)
    {
        $this->log_usuario = UserLogin::where('user_id', $id)->get();

        $this->name = User::find($id)->name;
    }

    public function render()
    {
        $sesiones = UserLogin::select('users.id as id_user', 'name', DB::raw('MAX(login_at) as last_login'))
            ->join('users', 'users.id', '=', 'user_id')
            ->where('name', 'LIKE', '%' . $this->usuario . '%')
            ->groupBy('name')
            ->orderBy('login_at', 'desc')
            ->paginate()
        ;

        return view('livewire.auditoria.sesion', compact('sesiones'));
    }
}
