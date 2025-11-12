<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $name, $email, $cedula, $password, $confirPass, $roles;

    public $selectedRoles = [];

    protected $rules = [
        'name' => 'required',
        'email' => 'required|unique:users,email',
        'cedula' => 'required|integer|min:1000000|max:50000000|unique:users,cedula',
        'selectedRoles.*' => 'required|array',
        'selectedRoles.*' => 'string|exists:roles,name',
    ];

    public function mount()
    {
        $this->roles = Role::all();
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
            'password' => bcrypt($this->cedula),
        ])/*->assignRole($this->role)*/;

        if (!empty($this->selectedRoles))
        {
            $user->syncRoles($this->selectedRoles);
        }

        return redirect()->route('users.index')->with('info', 'Usuario Registrado con Exito');
    }

    public function render()
    {
        return view('livewire.user.create');
    }
}
