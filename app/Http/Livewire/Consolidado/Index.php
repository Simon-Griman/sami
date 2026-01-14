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
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $fecha_inicio, $fecha_final, $instalacion, $ubicacion, $cliente, $producto, $segregacion, $destino, $volumen, $operacion, $borrar, $c_borrar, $mi_ubicacion, $sede;

    protected $paginationTheme = "bootstrap";

    public function mount()
    {
        $this->fecha_inicio = Consolidado::min('fecha');
        $this->fecha_final = Consolidado::max('fecha');

        $this->mi_ubicacion = User::find(Auth::id())->ubicacion_id;

        $this->sede = Ubicacion::where('nombre', 'Sede')->first()->id;
    }

    public function updatingFecha()
    {
        $this->resetPage();
    }

    public function updatingInstalacion()
    {
        $this->resetPage();
    }

    public function updatingUbicacion()
    {
        $this->resetPage();
    }

    public function updatingCliente()
    {
        $this->resetPage();
    }

    public function updatingProducto()
    {
        $this->resetPage();
    }

    public function updatingSegregacion()
    {
        $this->resetPage();
    }

    public function updatingDestino()
    {
        $this->resetPage();
    }

    public function updatingVolumen()
    {
        $this->resetPage();
    }

    public function confirBorrar($id)
    {
        $producto = Producto::find(Consolidado::find($id)->producto_id)->nombre;

        $this->borrar = $id;
        $this->c_borrar = $producto;
    }

    public function borrar()
    {
        Consolidado::find($this->borrar)->delete();
        
        $this->dispatchBrowserEvent('borrar');
    }

    public function render()
    {
        $consolidados = Consolidado::select('consolidados.id as id_consolidado', 'fecha', 'instalacions.id', 'instalacions.nombre as instalacion', 'ubicacions.id', 'ubicacions.nombre as ubicacion', 'cliente', 'productos.id', 'productos.nombre as producto', 'segregacions.nombre as segregacion', 'destino', 'volumen', 'operacion', 'certificado')
            ->join('instalacions', 'instalacions.id', '=', 'instalacion_id')
            ->join('ubicacions', 'ubicacions.id', '=', 'ubicacion_id')
            ->join('productos', 'productos.id', '=', 'producto_id')
            ->join('segregacions', 'segregacions.id', '=', 'segregacion_id')
            ->whereBetween('fecha', [$this->fecha_inicio, $this->fecha_final])
            ->where('instalacions.nombre', 'LIKE', '%' . $this->instalacion . '%')
            ->where('ubicacions.nombre', 'LIKE', '%' . $this->ubicacion . '%')
            ->where('cliente', 'LIKE', '%' . $this->cliente . '%')
            ->where('productos.nombre', 'LIKE', '%' . $this->producto . '%')
            ->where('segregacions.nombre', 'LIKE', '%' . $this->segregacion . '%')
            ->where('destino', 'LIKE', '%' . $this->destino . '%')
            ->where('volumen', 'LIKE', '%' . $this->volumen . '%')
            ->where('operacion','LIKE', '%' . $this->operacion . '%')
        ;

        if ($this->mi_ubicacion != $this->sede)
        {
            $consolidados->where('ubicacions.id', $this->mi_ubicacion);
        }

        $consolidados = $consolidados->orderBy('consolidados.created_at', 'desc')->paginate();

        $instalaciones = Instalacion::orderBy('nombre')->get();
        $ubicaciones = Ubicacion::orderBy('nombre')->get();
        $productos = Producto::orderBy('nombre')->get();
        $segregaciones = Segregacion::orderBy('nombre')->get();

        $certificado = Storage::files('public/certificados');

        return view('livewire.consolidado.index', compact('consolidados','instalaciones', 'ubicaciones', 'productos', 'segregaciones', 'certificado'));
    }
}
