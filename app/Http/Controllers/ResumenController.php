<?php

namespace App\Http\Controllers;

use App\Models\Consolidado;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ResumenController extends Controller
{
    public function index()
    {
        return view('resumen');
    }

    public function downloadPdf($selectedMonth, $selectedYear, $tipo, $operacion = '')
    {
        $total_barriles = 0; 
        $total_certificados = 0; 
        $total_mbd = 0; 
        $total_mmbls = 0;

        if ($tipo == 'ubicacion')
        {
            $resumen = Consolidado::select('fecha', 'ubicacions.nombre as ubicacion', DB::raw('SUM(volumen) as total_cantidad'), DB::raw('COUNT(ubicacions.nombre) as certificados'), 'operacion')
                ->join('ubicacions', 'ubicacions.id', '=', 'ubicacion_id')
                ->groupBy('ubicacions.nombre')
                ->whereYear('fecha', $selectedYear)
                ->whereMonth('fecha', $selectedMonth)
                ->where('operacion', 'LIKE', '%' . $operacion . '%')
                ->get()
            ;
        }

        else if ($tipo == 'producto')
        {
            $resumen = Consolidado::select('fecha', 'segregacions.nombre as producto', DB::raw('SUM(volumen) as total_cantidad'), DB::raw('COUNT(segregacions.nombre) as certificados'), 'operacion')
                ->join('segregacions', 'segregacions.id', '=', 'segregacion_id')
                ->groupBy('segregacions.nombre')
                ->whereYear('fecha', $selectedYear)
                ->whereMonth('fecha', $selectedMonth)
                ->where('operacion', 'LIKE', '%' . $operacion . '%')
                ->get()
            ;
        }

        else
        {
            return 'A ocurrido un error en la selección del resumen, por favor contactar al administrador del sistema';
        }

        $fecha = new Carbon();

        $mes_producto = $selectedMonth;
        $mes_ubicacion = $selectedMonth;
        $ano_producto = $selectedYear;
        $ano_ubicacion = $selectedYear;
        

        $pdf = Pdf::loadView('pdfs.resumen', ['mes_producto' => $mes_producto, 'mes_ubicacion' => $mes_ubicacion, 'ano_producto' => $ano_producto, 'ano_ubicacion' => $ano_ubicacion, 'resumen' => $resumen, 'fecha' => $fecha, 'tipo' => $tipo, 'total_barriles' => $total_barriles, 'total_certificados' => $total_certificados, 'total_mbd' => $total_mbd, 'total_mmbls' => $total_mmbls]);

        return $pdf->stream('resumen.pdf');
    }
}
