<?php

namespace App\Http\Livewire\Consolidado;

use App\Models\Consolidado;
use App\Models\Instalacion;
use App\Models\Producto;
use App\Models\Segregacion;
use App\Models\Ubicacion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $fecha, $instalacion, $ubicacion, $cliente, $producto, $segregacion, $destino, $volumen, $certificado, $operacion, $productos, $segregaciones, $mi_ubicacion, $sede, $ubicacion_actual;

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

    public function mount()
    {
        $this->productos = Producto::orderBy('nombre')->get();

        $this->segregaciones = collect();

        $this->mi_ubicacion = User::find(Auth::id())->ubicacion_id;

        $this->sede = Ubicacion::where('nombre', 'Sede')->first()->id;

        $this->ubicacion_actual = Ubicacion::find($this->mi_ubicacion);
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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function crear()
    {
        if ($this->mi_ubicacion != $this->sede)
        {
            $this->ubicacion = $this->mi_ubicacion;
        }
        
        $this->validate();

        $nombre = $this->certificado->store('certificados', 'public');

        Consolidado::create([
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

        //$this->reset('certificado');

        return redirect()->route('consolidado.index')->with('crear', 'Registrado con Exito');
    }

    public function render()
    {
        $instalacions = Instalacion::orderBy('nombre')->get();
        $ubicacions = Ubicacion::orderBy('nombre')->get();

        return view('livewire.consolidado.create', compact('instalacions', 'ubicacions'));
    }
}
