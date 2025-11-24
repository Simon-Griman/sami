<?php

namespace App\Http\Livewire;

use App\Models\Consolidado;
use App\Models\Segregacion as Segregaciones;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Segregacion extends Component
{
    public $crear = true, $borrar, $nombre, $hidrocarburo, $segregacion_id, $segregacion_borrar, $segregacion_nombre, $registros_vinculados = false;

    protected function rules()
    {
        return [
            'nombre' => ['required', Rule::unique('segregacions', 'nombre')->ignore($this->segregacion_id)],
            'hidrocarburo' => 'required',
        ];
    }

    public function modalCrear()
    {
        $this->crear = true;
        $this->limpiarCampos();
    }

    public function crear()
    {
        $this->validate();

        Segregaciones::create([
            'nombre' => $this->nombre,
            'hidrocarburo' => $this->hidrocarburo,
        ]);

        $this->limpiarCampos();
        $this->dispatchBrowserEvent('crear');
    }

    public function modalEditar($id)
    {
        $this->crear = false;

        $segregacion = Segregaciones::findOrFail($id);

        $this->segregacion_id = $id;
        $this->nombre = $segregacion->nombre;
        $this->hidrocarburo = $segregacion->hidrocarburo;
    }

    public function editar()
    {
        $this->validate();

        $segregacion = Segregaciones::findOrFail($this->segregacion_id);

        $segregacion->update([
            'nombre' => $this->nombre,
            'hidrocarburo' => $this->hidrocarburo,
        ]);

        $this->limpiarCampos();
        $this->dispatchBrowserEvent('editar');
    }

    public function limpiarCampos()
    {
        $this->segregacion_id = '';
        $this->nombre = '';
        $this->hidrocarburo = '';
        $this->registros_vinculados = false;
    }

    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->segregacion_borrar = Segregaciones::find($id)->nombre;

        if (Consolidado::where('segregacion_id', $id)->exists())
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
        Segregaciones::find($this->borrar)->delete();

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
        $segregaciones = Segregaciones::orderBy('nombre')->where('nombre', 'LIKE', '%' . $this->segregacion_nombre . '%')->get();

        return view('livewire.segregacion', compact('segregaciones'));
    }
}
