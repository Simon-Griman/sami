<?php

namespace App\Http\Livewire;

use App\Models\Consolidado;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Resumen extends Component
{
    public $selectedMonth, $selectedMonth2, $selectedYear, $selectedYear2;

    public function mount()
    {
        $this->selectedYear = date('Y');
        $this->selectedMonth = date('m');
        $this->selectedYear2 = date('Y');
        $this->selectedMonth2 = date('m');
    }

    public function render()
    {
        $resumen_ubicacion = Consolidado::select('fecha', 'ubicacions.nombre as ubicacion', DB::raw('SUM(volumen) as total_cantidad'), DB::raw('COUNT(ubicacions.nombre) as certificados'))
            ->join('ubicacions', 'ubicacions.id', '=', 'ubicacion_id')
            ->groupBy('ubicacions.nombre')
            ->whereYear('fecha', $this->selectedYear)
            ->whereMonth('fecha', $this->selectedMonth)
            ->get()
        ;

        $resumen_producto = Consolidado::select('fecha', 'segregacions.nombre as productos', DB::raw('SUM(volumen) as total_cantidad'), DB::raw('COUNT(segregacions.nombre) as certificados'))
            ->join('segregacions', 'segregacions.id', '=', 'segregacion_id')
            ->groupBy('segregacions.nombre')
            ->whereYear('fecha', $this->selectedYear2)
            ->whereMonth('fecha', $this->selectedMonth2)
            ->get()
        ;

        $fecha = new Carbon();

        return view('livewire.resumen', compact('resumen_ubicacion', 'resumen_producto', 'fecha'));
    }
}
