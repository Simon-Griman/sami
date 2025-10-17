<?php

namespace App\Http\Livewire\Consolidado;

use App\Models\Consolidado;
use App\Models\Instalacion;
use App\Models\Producto;
use App\Models\Ubicacion;
use Livewire\Component;

class Create extends Component
{
    public $fecha, $instalacion, $ubicacion, $cliente, $producto, $segregacion, $destino, $volumen;

    protected $rules = [
        'fecha' => 'required',
        'instalacion' => 'required',
        'ubicacion' => 'required',
        'cliente' => 'required',
        'producto' => 'required',
        'segregacion' => 'required',
        'destino' => 'required',
        'volumen' => 'required|integer'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function crear()
    {
        $this->validate();

        Consolidado::create([
            'fecha' => $this->fecha,
            'instalacion_id' => $this->instalacion,
            'ubicacion_id' => $this->ubicacion,
            'cliente' => $this->cliente,
            'producto_id' => $this->producto,
            'segregacion' => $this->segregacion,
            'destino' => $this->destino,
            'volumen' => $this->volumen,
        ]);

        return redirect()->route('consolidado.index')->with('crear', 'Registrado con Exito');
    }

    public function render()
    {
        $instalacions = Instalacion::all();
        $ubicacions = Ubicacion::all();
        $productos = Producto::all();

        return view('livewire.consolidado.create', compact('instalacions', 'ubicacions', 'productos'));
    }
}
