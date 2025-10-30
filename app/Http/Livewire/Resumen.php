<?php

namespace App\Http\Livewire;

use App\Models\Consolidado;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Resumen extends Component
{
    public $selectedMonth, $selectedYear;

    public function mount()
    {
        $this->selectedYear = date('Y');
        $this->selectedMonth = date('m');
    }

    public function render()
    {
        $resumen = Consolidado::select('fecha', 'ubicacions.nombre as ubicacion', DB::raw('SUM(volumen) as total_cantidad'), DB::raw('COUNT(ubicacions.nombre) as certificados'))
            ->join('ubicacions', 'ubicacions.id', '=', 'ubicacion_id')
            ->groupBy('ubicacions.nombre')
            ->whereYear('fecha', $this->selectedYear)
            ->whereMonth('fecha', $this->selectedMonth)
            ->get()
        ;

        $fecha = new Carbon();

        return view('livewire.resumen', compact('resumen', 'fecha'));
    }
}
