<?php

namespace App\Http\Livewire\Consolidado;

use App\Models\Consolidado;
use App\Models\Instalacion;
use App\Models\Producto;
use App\Models\Ubicacion;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $fecha, $instalacion, $ubicacion, $cliente, $producto, $segregacion, $destino, $volumen, $borrar, $c_borrar;

    protected $paginationTheme = "bootstrap";

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
        $consolidado = Consolidado::find($this->borrar);

        //$user = Auth::User()->name; //saber quien borro el registro

        $consolidado->update([
            'borrado' => '1',
            //'user_borrar' => $user,
        ]);
        
        $this->dispatchBrowserEvent('borrar');
    }

    public function render()
    {
        $consolidados = Consolidado::select('consolidados.id as id_consolidado', 'fecha', 'instalacions.id', 'instalacions.nombre as instalacion', 'ubicacions.id', 'ubicacions.nombre as ubicacion', 'cliente', 'productos.id', 'productos.nombre as producto', 'segregacion', 'destino', 'volumen')
            ->join('instalacions', 'instalacions.id', '=', 'instalacion_id')
            ->join('ubicacions', 'ubicacions.id', '=', 'ubicacion_id')
            ->join('productos', 'productos.id', '=', 'producto_id')
            ->where('fecha', 'LIKE', '%' . $this->fecha . '%')
            ->where('instalacions.nombre', 'LIKE', '%' . $this->instalacion . '%')
            ->where('ubicacions.nombre', 'LIKE', '%' . $this->ubicacion . '%')
            ->where('cliente', 'LIKE', '%' . $this->cliente . '%')
            ->where('productos.nombre', 'LIKE', '%' . $this->producto . '%')
            ->where('segregacion', 'LIKE', '%' . $this->segregacion . '%')
            ->where('destino', 'LIKE', '%' . $this->destino . '%')
            ->where('volumen', 'LIKE', '%' . $this->volumen . '%')
            ->where('borrado', '0')
            ->paginate()
        ;

        $instalaciones = Instalacion::all();
        $ubicaciones = Ubicacion::all();
        $productos = Producto::all();

        return view('livewire.consolidado.index', compact('consolidados','instalaciones', 'ubicaciones', 'productos'));
    }
}
