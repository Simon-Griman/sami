<?php

namespace App\Http\Livewire\User;

use App\Models\Ubicacion;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $name, $email, $cedula, $ubicacion;

    public $selectedRoles = [];
    public $selectedUbicaciones = [];

    // Colecciones para renderizar vistas
    public $roles;
    public $ubicaciones;

    protected $rules = [
        'name' => 'required|max:45',
        'email' => 'required|email|unique:users,email',
        'cedula' => 'required|integer|min:1000000|max:50000000|unique:users,cedula',
        'ubicacion' => 'required|exists:ubicacions,id',
        'selectedRoles' => 'nullable|array',
        'selectedRoles.*' => 'exists:roles,name',
        'selectedUbicaciones' => 'nullable|array',
        'selectedUbicaciones.*' => 'exists:ubicacions,id', // O 'ubicacions,id' según se llame tu tabla
    ];

    public function mount()
    {
        $this->roles = Role::where('name', '!=', 'Super-Admin')->get();
        $this->ubicaciones = Ubicacion::orderBy('nombre')->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function crear()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'cedula' => $this->cedula,
            'ubicacion_id' => $this->ubicacion,
            'password' => bcrypt($this->cedula),
        ]);

        if (!empty($this->selectedRoles)) {
            $user->syncRoles($this->selectedRoles);
        }

        if (!empty($this->selectedUbicaciones)) {
            $user->ubicaciones()->sync($this->selectedUbicaciones);
        }

        return redirect()->route('users.index')->with('info', 'Usuario Registrado con Éxito');
    }

    public function render()
    {
        return view('livewire.user.create');
    }
}