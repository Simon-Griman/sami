<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $id_user;

    public function editar()
    {
        $user = User::find($this->id_user);

        $user->update([
            'password' => bcrypt($user->cedula),
            'new_user' => '1',
        ]);

        return redirect()->route('users.edit', $user)->with('info', 'Contraseña Actualizada con Exito');
    }

    public function render()
    {
        return view('livewire.user.edit');
    }
}
