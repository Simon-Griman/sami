<?php

namespace App\Http\Livewire\User;

use App\Models\Ubicacion;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $id_user, $user, $ubicacion;

    protected $rules = [
        'ubicacion' => 'required',
    ];

    public function mount()
    {
        $this->user = User::find($this->id_user);

        $this->ubicacion = $this->user->ubicacion_id;
    }

    public function ubicacion()
    {
        $this->validate();

        $this->user->update([
            'ubicacion_id' => $this->ubicacion,
        ]);

        return redirect()->route('users.edit', $this->user)->with('info', 'Ubicación Actualizada con Exito');
    }

    public function pass()
    {
        $this->user->update([
            'password' => bcrypt($this->user->cedula),
            'new_user' => '1',
        ]);

        return redirect()->route('users.edit', $this->user)->with('info', 'Contraseña Actualizada con Exito');
    }

    public function render()
    {
        $ubicaciones = Ubicacion::orderBy('nombre')->get();

        return view('livewire.user.edit', compact('ubicaciones'));
    }
}
