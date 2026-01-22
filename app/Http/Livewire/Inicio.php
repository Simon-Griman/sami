<?php

namespace App\Http\Livewire;

use App\Models\Consolidado;
use App\Models\RegistrosCreados;
use App\Models\Ubicacion;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Inicio extends Component
{
    public $ubicacion='', $total_consolidado, $fecha_inicio, $fecha_final, $nombre_mes_anterior;

    public $orderData = [];

    public function mount()
    {   
        $this->fecha_inicio = Consolidado::min('fecha');
        $this->fecha_final = Consolidado::max('fecha');

        $this->loadData();

        $this->total_consolidado = Consolidado::count();
    }

    public function loadData()
    {
        $valores = Consolidado::select('ubicacions.nombre as ubicacion', DB::raw('COUNT(consolidados.id) as cantidad'))
            ->join('ubicacions', 'ubicacions.id', '=', 'ubicacion_id')
            ->groupBy('ubicacion_id')
            ->whereBetween('fecha', [$this->fecha_inicio, $this->fecha_final])
            ->orderBy('ubicacions.nombre')
        ;

        $this->orderData = [
            'values' => $valores->pluck('cantidad')->toArray(),
            'labels' => $valores->pluck('ubicacion')->toArray(),
        ];
    }

    public function refreshData()
    {
        $this->loadData(); // Recalcula los datos
        $this->emit('updateChart', $this->orderData); // Envía los nuevos datos al JS
    }

    public function refreshDataUser()
    {
        $valores = RegistrosCreados::select('users.name as user', 'model_type', DB::raw('COUNT(registros_creados.id) as cantidad'))
            ->join('users', 'users.id', '=', 'user_id')
            ->where('model_type', 'App\\Models\\Consolidado')
            ->whereDate('registros_creados.created_at', '>=', $this->fecha_inicio)
            ->whereDate('registros_creados.created_at', '<=', $this->fecha_final)
            ->groupBy('users.name')
            ->orderBy('users.name')
        ;

        $this->orderData = [
            'values' => $valores->pluck('cantidad')->toArray(),
            'labels' => $valores->pluck('user')->toArray(),
        ];

        $this->emit('updateChart', $this->orderData); // Envía los nuevos datos al JS
    }

    public function render()
    {
        $mesPasado = now()->subMonth();

        $this->nombre_mes_anterior = now()->subMonth()->translatedFormat('F');

        $user_mes = RegistrosCreados::select('users.name as user', 'model_type', DB::raw('COUNT(registros_creados.id) as cantidad'))
            ->join('users', 'users.id', '=', 'user_id')
            ->where('model_type', 'App\\Models\\Consolidado')
            ->whereMonth('registros_creados.created_at', $mesPasado->month)
            ->whereYear('registros_creados.created_at', $mesPasado->year)
            ->groupBy('users.name')
            ->orderBy('cantidad', 'desc')
            ->first()
        ;

        $consolidado_ubicacion = Consolidado::select('ubicacions.nombre as ubicacion', DB::raw('COUNT(consolidados.id) as cantidad'))
            ->join('ubicacions', 'ubicacions.id', '=', 'ubicacion_id')
            ->where('ubicacions.nombre', $this->ubicacion)
            ->first()
        ;

        $ubicaciones = Ubicacion::orderBy('nombre')->get();

        return view('livewire.inicio', compact('consolidado_ubicacion', 'ubicaciones', 'user_mes'));
    }
}
