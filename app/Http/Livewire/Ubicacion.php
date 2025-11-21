<?php

namespace App\Http\Livewire;

use App\Models\Ubicacion as Ubicaciones;
use Livewire\Component;

class Ubicacion extends Component
{
    public $crear = true, $borrar, $ubicacion_id, $ubicacion_borrar, $nombre, $nombre_ubicacion;

    protected $rules = [
        'nombre' => 'required|unique:ubicacions,nombre',
    ];

    public function modalCrear()
    {
        $this->crear = true;
        $this->limpiarCampos();
    }

    public function crear()
    {
        $this->validate();

        Ubicaciones::create([
            'nombre' => $this->nombre,
        ]);

        $this->limpiarCampos();
        $this->dispatchBrowserEvent('crear');
    }

    public function modalEditar($id)
    {
        $this->crear = false;

        $ubicacion = Ubicaciones::findOrFail($id);

        $this->ubicacion_id = $id;
        $this->nombre = $ubicacion->nombre;
    }

    public function editar()
    {
        $this->validate();

        $ubicacion = Ubicaciones::findOrFail($this->ubicacion_id);

        $ubicacion->update([
            'nombre' => $this->nombre,
        ]);

        $this->limpiarCampos();
        $this->dispatchBrowserEvent('editar');
    }

    public function limpiarCampos()
    {
        $this->ubicacion_id = '';
        $this->nombre = '';
    }

    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->ubicacion_borrar = Ubicaciones::find($id)->nombre;
    }

    public function borrar()
    {
        Ubicaciones::find($this->borrar)->delete();

        $this->dispatchBrowserEvent('borrar');
    }

    public function render()
    {
        $ubicaciones = Ubicaciones::orderBy('nombre')->where('nombre', 'LIKE', '%' . $this->nombre_ubicacion . '%')->get();

        return view('livewire.ubicacion', compact('ubicaciones'));
    }
}
