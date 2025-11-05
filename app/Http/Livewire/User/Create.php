<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $name, $email, $cedula, $password, $confirPass;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|unique:users,email',
        'cedula' => 'required|integer|min:1000000|max:50000000|unique:users,cedula',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function crear()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'cedula' => $this->cedula,
            'password' => bcrypt($this->cedula),
        ])->assignRole('Admin'); //nuevo-usuario

        return redirect()->route('users.index')->with('info', 'Usuario Registrado con Exito');
    }

    public function render()
    {
        return view('livewire.user.create');
    }
}
