<?php

namespace App\Http\Livewire;

use App\Models\Consolidado;
use App\Models\Ubicacion as Ubicaciones;
use Livewire\Component;

class Ubicacion extends Component
{
    public $crear = true, $borrar, $ubicacion_id, $ubicacion_borrar, $nombre, $nombre_ubicacion, $registros_vinculados = false;

    protected $rules = [
        'nombre' => 'required|unique:ubicacions,nombre|max:45',
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
        $this->registros_vinculados = false;
    }

    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->ubicacion_borrar = Ubicaciones::find($id)->nombre;

        if (Consolidado::where('ubicacion_id', $id)->exists())
        {
            $this->registros_vinculados = true;
        }
    }

    public function dobleConfirBorrar()
    {
        $this->dispatchBrowserEvent('borrar2');
    }

    public function borrar()
    {
        Ubicaciones::find($this->borrar)->delete();

        if ($this->registros_vinculados)
        {
            $this->dispatchBrowserEvent('borrar3');
        }
        else
        {
            $this->dispatchBrowserEvent('borrar');
        }

        $this->limpiarCampos();
    }

    public function render()
    {
        $ubicaciones = Ubicaciones::orderBy('nombre')->where('nombre', 'LIKE', '%' . $this->nombre_ubicacion . '%')->get();

        return view('livewire.ubicacion', compact('ubicaciones'));
    }
}
