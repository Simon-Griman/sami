<?php

namespace App\Http\Livewire\Consolidado;

use App\Models\Consolidado;
use App\Models\Instalacion;
use App\Models\Producto;
use App\Models\Ubicacion;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $consolidado;

    public $fecha, $instalacion, $ubicacion, $cliente, $producto, $segregacion, $destino, $volumen, $certificado, $certificado_existente;

    public function mount()
    {
        $this->fecha = $this->consolidado->fecha;
        $this->instalacion = $this->consolidado->instalacion_id;
        $this->ubicacion = $this->consolidado->ubicacion_id;
        $this->cliente = $this->consolidado->cliente;
        $this->producto = $this->consolidado->producto_id;
        $this->segregacion = $this->consolidado->segregacion;
        $this->destino = $this->consolidado->destino;
        $this->volumen = $this->consolidado->volumen;
        $this->certificado_existente = $this->consolidado->certificado;
    }

    protected $rules = [
        'fecha' => 'required',
        'instalacion' => 'required',
        'ubicacion' => 'required',
        'cliente' => 'required',
        'producto' => 'required',
        'segregacion' => 'required',
        'destino' => 'required',
        'volumen' => 'required',
        'certificado' => 'nullable|file|mimes:pdf|max:2048',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function actualizar()
    {
        $this->validate();

        $consolidado = Consolidado::find($this->consolidado->id);

        if ($this->certificado)
        {
            $nombre = $this->certificado->store('certificados', 'public');

            Storage::disk('public')->delete($this->certificado_existente);
        }

        else
        {
            $nombre = $consolidado->certificado;
        }

        $consolidado->update([
            'fecha' => $this->fecha,
            'instalacion_id' => $this->instalacion,
            'ubicacion_id' => $this->ubicacion,
            'cliente' => $this->cliente,
            'producto_id' => $this->producto,
            'segregacion' => $this->segregacion,
            'destino' => $this->destino,
            'volumen' => $this->volumen,
            'certificado' => $nombre
        ]);

        return redirect()
            ->route('consolidado.index')
            ->with('actualizar', 'Registro actualizado con exito')
        ;
    }

    public function render()
    {
        $instalacions = Instalacion::orderBy('nombre')->get();
        $ubicacions = Ubicacion::orderBy('nombre')->get();
        $productos = Producto::orderBy('nombre')->get();    

        return view('livewire.consolidado.edit', compact('instalacions', 'ubicacions', 'productos'));
    }
}
