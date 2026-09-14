<?php

namespace App\Http\Livewire\User;

use App\Models\Ubicacion;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $id_user, $user;

    // Arreglo para almacenar los IDs de las ubicaciones seleccionadas
    public $selectedUbicaciones = [];

    protected $rules = [
        'selectedUbicaciones' => 'nullable|array',
        'selectedUbicaciones.*' => 'exists:ubicacions,id', // Cambia a 'ubicacions,id' si ese es el nombre exacto de tu tabla
    ];

    public function mount()
    {
        $this->user = User::find($this->id_user);

        // Pre-cargamos los IDs de las ubicaciones que ya tiene asignadas el usuario
        $this->selectedUbicaciones = $this->user->ubicaciones()->pluck('ubicacions.id')->toArray();
    }

    public function ubicacion()
    {
        $this->validate();

        // Sincronizamos los IDs seleccionados en la tabla pivote
        $this->user->ubicaciones()->sync($this->selectedUbicaciones);

        return redirect()->route('users.edit', $this->user)->with('info', 'Ubicaciones Actualizadas con Éxito');
    }

    public function pass()
    {
        $this->user->update([
            'password' => bcrypt($this->user->cedula),
            'new_user' => '1',
        ]);

        return redirect()->route('users.edit', $this->user)->with('info', 'Contraseña Actualizada con Éxito');
    }

    public function render()
    {
        $ubicaciones = Ubicacion::orderBy('nombre')->get();

        return view('livewire.user.edit', compact('ubicaciones'));
    }
}