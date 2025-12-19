<?php

namespace App\Http\Livewire\Auditoria;

use App\Models\Consolidado;
use App\Models\RegistrosEliminados as Eliminados;
use App\Models\Respaldo;
use Livewire\Component;

class RegistrosEliminados extends Component
{
    public $usuario, $tabla, $id_consolidado, $name_table, $name, $modelo;

    public function mount()
    {
        $this->modelo = Consolidado::first();
    }

    public function verConsolidado($name, $id)
    {
        $this->name_table = 'consolidado';
        $this->name = $name;

        $this->modelo = Consolidado::select('consolidados.id as id_consolidado', 'fecha', 'instalacions.id', 'instalacions.nombre as instalacion', 'ubicacions.id', 'ubicacions.nombre as ubicacion', 'cliente', 'productos.id', 'productos.nombre as producto', 'segregacions.nombre as segregacion', 'destino', 'volumen', 'operacion', 'certificado', 'deleted_at')
            ->join('instalacions', 'instalacions.id', '=', 'instalacion_id')
            ->join('ubicacions', 'ubicacions.id', '=', 'ubicacion_id')
            ->join('productos', 'productos.id', '=', 'producto_id')
            ->join('segregacions', 'segregacions.id', '=', 'segregacion_id')
            ->where('consolidados.id', $id)
            ->withTrashed()
            ->first()
        ;
    }

    public function verUbicacion($name, $id)
    {
        $this->name_table = 'ubicacion';
        $this->name = $name;

        $this->modelo = Respaldo::where('ubicacion_id', $id)->first();
    }

    public function verSegregacion($name, $id)
    {
        $this->name_table = 'segregacion';
        $this->name = $name;

        $this->modelo = Respaldo::where('segregacion_id', $id)->first();
    }

    public function verUser($name, $id)
    {
        $this->name_table = 'usuario';
        $this->name = $name;

        $this->modelo = Respaldo::where('user_id', $id)->first();
    }

    public function verRole($name, $id)
    {
        $this->name_table = 'role';
        $this->name = $name;

        $this->modelo = Respaldo::where('role_id', $id)->first();
    }

    public function verCintillo($name, $id)
    {
        $this->name_table = 'cintillo';
        $this->name = $name;

        $this->modelo = Respaldo::where('cintillo_id', $id)->first();
    }

    public function render()
    {
        $registros = Eliminados::select('name', 'model_type', 'model_id', 'registros_eliminados.created_at')
            ->join('users', 'users.id', '=', 'user_id')
            ->where('name', 'LIKE', '%' . $this->usuario . '%')
            ->where('model_type', 'LIKE', '%' . $this->tabla . '%')
            ->where('model_id', 'LIKE', '%' . $this->id_consolidado . '%')
            ->orderBy('created_at')
            ->paginate()
        ;

        return view('livewire.auditoria.registros-eliminados', compact('registros'));
    }
}
