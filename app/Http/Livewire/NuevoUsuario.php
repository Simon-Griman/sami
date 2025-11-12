<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NuevoUsuario extends Component
{
    public $password, $confirPass;

    protected $rules = [
        'password' => 'required|min:8',
        'confirPass' => 'required|same:password',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editar()
    {
        $this->validate();

        $user = User::find(Auth::User()->id);

        $user->update([
            'password' => bcrypt($this->password),
            'new_user' => '0',
        ]);

        //$user->roles()->sync([3]);

        return redirect()->route('home');
    }

    public function render()
    {
        $myuser = Auth::User()->name;

        return view('livewire.nuevo-usuario', compact('myuser'));
    }
}
