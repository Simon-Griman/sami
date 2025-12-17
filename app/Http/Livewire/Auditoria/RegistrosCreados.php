<?php

namespace App\Http\Livewire\Auditoria;

use App\Models\Cintillo;
use App\Models\Consolidado;
use App\Models\RegistrosCreados as Creados;
use App\Models\Role;
use App\Models\Segregacion;
use App\Models\Ubicacion;
use App\Models\User;
use Livewire\Component;

class RegistrosCreados extends Component
{
    public $usuario, $id_registro, $name, $id_consolidado, $tabla, $consolidado, $ubicacion, $segregacion, $user, $cintillo, $role, $name_table;

    public function verConsolidado($name, $id)
    {
        $this->name_table = 'consolidado';
        $this->name = $name;
        
        $this->consolidado = Consolidado::select('consolidados.id as id_consolidado', 'fecha', 'instalacions.id', 'instalacions.nombre as instalacion', 'ubicacions.id', 'ubicacions.nombre as ubicacion', 'cliente', 'productos.id', 'productos.nombre as producto', 'segregacions.nombre as segregacion', 'destino', 'volumen', 'operacion', 'certificado')
            ->join('instalacions', 'instalacions.id', '=', 'instalacion_id')
            ->join('ubicacions', 'ubicacions.id', '=', 'ubicacion_id')
            ->join('productos', 'productos.id', '=', 'producto_id')
            ->join('segregacions', 'segregacions.id', '=', 'segregacion_id')
            ->where('consolidados.id', $id)
            ->first()
        ;
    }

    public function verUbicacion($name, $id)
    {
        $this->name_table = 'ubicacion';
        $this->name = $name;

        $this->ubicacion = Ubicacion::find($id);
    }

    public function verSegregacion($name, $id)
    {
        $this->name_table = 'segregacion';
        $this->name = $name;

        $this->segregacion = Segregacion::find($id);
    }

    public function verUser($name, $id)
    {
        $this->name_table = 'usuario';
        $this->name = $name;

        $this->user = User::find($id);
    }

    public function verCintillo($name, $id)
    {
        $this->name_table = 'cintillo';
        $this->name = $name;

        $this->cintillo = Cintillo::find($id);
    }

    public function verRole($name, $id)
    {
        $this->name_table = 'role';
        $this->name = $name;

        $this->role = Role::find($id);
    }

    public function render()
    {
        $registros = Creados::select('name', 'model_type', 'model_id', 'registros_creados.created_at')
            ->join('users', 'users.id', '=', 'user_id')
            ->where('name', 'LIKE', '%' . $this->usuario . '%')
            ->where('model_type', 'LIKE', '%' . $this->tabla . '%')
            ->where('model_id', 'LIKE', '%' . $this->id_consolidado . '%')
            ->orderBy('created_at')
            ->paginate()
        ;

        return view('livewire.auditoria.registros-creados', compact('registros'));
    }
}
