<?php

namespace App\Http\Controllers;

use App\Models\Consolidado;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ResumenController extends Controller
{
    public function index()
    {
        return view('resumen');
    }

    public function downloadPdf($selectedMonth, $selectedYear)
    {
        $resumen = Consolidado::select('fecha', 'ubicacions.nombre as ubicacion', DB::raw('SUM(volumen) as total_cantidad'), DB::raw('COUNT(ubicacions.nombre) as certificados'))
            ->join('ubicacions', 'ubicacions.id', '=', 'ubicacion_id')
            ->groupBy('ubicacions.nombre')
            ->whereYear('fecha', $selectedYear)
            ->whereMonth('fecha', $selectedMonth)
            ->get()
        ;

        $fecha = new Carbon();

        $pdf = Pdf::loadView('pdfs.resumen', ['selectedMonth' => $selectedMonth, 'selectedYear' => $selectedYear, 'resumen' => $resumen, 'fecha' => $fecha]);

        return $pdf->stream('resumen.pdf');
    }
}
