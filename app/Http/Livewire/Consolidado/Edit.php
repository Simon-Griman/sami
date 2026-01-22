<?php

namespace App\Http\Livewire\Consolidado;

use App\Models\Consolidado;
use App\Models\Instalacion;
use App\Models\Producto;
use App\Models\Segregacion;
use App\Models\Ubicacion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $consolidado;

    public $fecha, $instalacion, $ubicacion, $cliente, $producto, $segregacion, $destino, $volumen, $certificado, $certificado_existente, $operacion, $productos, $segregaciones, $mi_ubicacion, $sede, $ubicacion_actual;

    public function mount()
    {
        $this->fecha = $this->consolidado->fecha;
        $this->instalacion = $this->consolidado->instalacion_id;
        $this->ubicacion = $this->consolidado->ubicacion_id;
        $this->cliente = $this->consolidado->cliente;
        $this->producto = $this->consolidado->producto_id;
        $this->segregacion = $this->consolidado->segregacion_id;
        $this->destino = $this->consolidado->destino;
        $this->volumen = $this->consolidado->volumen;
        $this->operacion = $this->consolidado->operacion;
        $this->certificado_existente = $this->consolidado->certificado;

        $this->productos = Producto::orderBy('nombre')->get();

        $this->mi_ubicacion = User::find(Auth::id())->ubicacion_id;

        $this->sede = Ubicacion::where('nombre', 'Sede')->first()->id;

        $this->ubicacion_actual = Ubicacion::find($this->ubicacion);

        $hidrocarburo = '';

        if ($this->producto == 1) $hidrocarburo = 'Producto';

        else if ($this->producto == 2) $hidrocarburo = 'Crudo';

        $this->segregaciones = Segregacion::where('hidrocarburo', $hidrocarburo)->orderBy('nombre')->get();;
    }

    public function updatedProducto($value)
    {
        $hidrocarburo = '';

        if ($value == 1)
        {
            $hidrocarburo = 'Producto';
        }
        else if ($value == 2)
        {
            $hidrocarburo = 'Crudo';
        }

        $this->segregaciones = Segregacion::where('hidrocarburo', $hidrocarburo)->orderBy('nombre')->get();
        $this->segregacion = $this->segregaciones->first()->id ?? null;
    }

    protected function rules()
    {
        return [
            'fecha' => 'required|date|after_or_equal:' . now()->startOfMonth()->format('Y-m-d') . '|before_or_equal:today',
            'instalacion' => 'required',
            'ubicacion' => 'required',
            'cliente' => 'required|max:45',
            'producto' => 'required',
            'segregacion' => 'required',
            'destino' => 'required|max:45',
            'volumen' => 'required|integer',
            'operacion' => 'required',
            'certificado' => 'required|file|mimes:pdf|max:2048',
        ];
    }

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
            'segregacion_id' => $this->segregacion,
            'destino' => $this->destino,
            'volumen' => $this->volumen,
            'operacion' => $this->operacion,
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

        return view('livewire.consolidado.edit', compact('instalacions', 'ubicacions'));
    }
}
