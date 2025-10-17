<?php

namespace App\Http\Livewire\Consolidado;

use App\Models\Consolidado;
use App\Models\Instalacion;
use App\Models\Producto;
use App\Models\Ubicacion;
use Livewire\Component;

class Edit extends Component
{
    public $consolidado;

    public $fecha, $instalacion, $ubicacion, $cliente, $producto, $segregacion, $destino;

    public function mount()
    {
        $this->fecha = $this->consolidado->fecha;
        $this->instalacion = $this->consolidado->instalacion_id;
        $this->ubicacion = $this->consolidado->ubicacion_id;
        $this->cliente = $this->consolidado->cliente;
        $this->producto = $this->consolidado->producto_id;
        $this->segregacion = $this->consolidado->segregacion;
        $this->destino = $this->consolidado->destino;
    }

    protected $rules = [
        'fecha' => 'required',
        'instalacion' => 'required',
        'ubicacion' => 'required',
        'cliente' => 'required',
        'producto' => 'required',
        'segregacion' => 'required',
        'destino' => 'required'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function actualizar()
    {
        $this->validate();

        $consolidado = Consolidado::find($this->consolidado->id);

        $consolidado->update([
            'fecha' => $this->fecha,
            'instalacion_id' => $this->instalacion,
            'ubicacion_id' => $this->ubicacion,
            'cliente' => $this->cliente,
            'producto_id' => $this->producto,
            'segregacion' => $this->segregacion,
            'destino' => $this->destino,
        ]);

        return redirect()
            ->route('consolidado.index')
            ->with('actualizar', 'Registro actualizado con exito')
        ;
    }

    public function render()
    {
        $instalacions = Instalacion::all();
        $ubicacions = Ubicacion::all();
        $productos = Producto::all();

        return view('livewire.consolidado.edit', compact('instalacions', 'ubicacions', 'productos'));
    }
}
