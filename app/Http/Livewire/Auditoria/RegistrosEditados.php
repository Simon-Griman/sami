<?php

namespace App\Http\Livewire\Auditoria;

use App\Models\Consolidado;
use App\Models\RegistrosEditados as Editados;
use App\Models\Respaldo;
use App\Models\RespaldoEditados;
use Livewire\Component;

class RegistrosEditados extends Component
{
    public $usuario, $tabla, $id_tabla, $name_table, $name, $modelos;

    public function verConsolidado($name, $id)
    {
        $this->name_table = 'consolidado';
        $this->name = $name;

        $this->modelos = RespaldoEditados::where('batch_id', $id)->get();
    }

    public function verUbicacion($name, $id)
    {
        $this->name_table = 'ubicacion';
        $this->name = $name;

        $this->modelos = RespaldoEditados::where('batch_id', $id)->first();
    }

    public function verSegregacion($name, $id)
    {
        $this->name_table = 'segregacion';
        $this->name = $name;

        $this->modelos = RespaldoEditados::where('batch_id', $id)->get();
    }

    public function verUser($name, $id)
    {
        $this->name_table = 'usuario';
        $this->name = $name;

        $this->modelos = RespaldoEditados::where('batch_id', $id)->get();
    }

    public function verRole($name, $id)
    {
        $this->name_table = 'role';
        $this->name = $name;

        $this->modelos = RespaldoEditados::where('batch_id', $id)->first();
    }

    public function verCintillo($name, $id)
    {
        $this->name_table = 'cintillo';
        $this->name = $name;

        $this->modelos = Respaldo::where('batch_id', $id)->first();
    }

    public function render()
    {
        $registros = Editados::select('name', 'model_type', 'model_id', 'batch_id', 'registros_editados.created_at')
            ->join('users', 'users.id', '=', 'user_id')
            ->where('name', 'LIKE', '%' . $this->usuario . '%')
            ->where('model_type', 'LIKE', '%' . $this->tabla . '%')
            ->where('model_id', 'LIKE', '%' . $this->id_tabla . '%')
            ->orderBy('created_at')
            ->paginate()
        ;

        return view('livewire.auditoria.registros-editados', compact('registros'));
    }
}