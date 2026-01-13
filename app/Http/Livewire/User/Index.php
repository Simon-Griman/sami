<?php

namespace App\Http\Livewire\User;

use App\Models\Ubicacion;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $nombre, $email, $cedula, $ubicacion, $borrar, $user_borrar;

    protected $paginationTheme = "bootstrap";

    public function updatingNombre()
    {
        $this->resetPage();
    }

    public function updatingEmail()
    {
        $this->resetPage();
    }

    public function updatingCedula()
    {
        $this->resetPage();
    }

    public function updatingUbicacion()
    {
        $this->resetPage();
    }

    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->user_borrar = User::find($id)->name;
    }

    public function borrar()
    {
        User::find($this->borrar)->delete();
        
        $this->dispatchBrowserEvent('borrar');
    }

    public function render()
    {
        $users = User::select('users.id' ,'name', 'email', 'cedula', 'ubicacions.nombre as ubicacion')
            ->join('ubicacions', 'ubicacions.id', '=', 'ubicacion_id')
            ->where('name', 'LIKE', '%' . $this->nombre . '%')
            ->where('email', 'LIKE', '%' . $this->email . '%')
            ->where('cedula', 'LIKE', '%' . $this->cedula . '%')
            ->where('ubicacions.nombre', 'LIKE', '%' . $this->ubicacion . '%')
            ->paginate()
        ;

        $ubicaciones = Ubicacion::orderBy('nombre')->get();

        return view('livewire.user.index', compact('users', 'ubicaciones'));
    }
}
