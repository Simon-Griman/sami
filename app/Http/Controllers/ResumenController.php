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

    public function downloadPdf($selectedMonth, $selectedYear, $tipo)
    {
        if ($tipo == 'ubicacion')
        {
            $resumen = Consolidado::select('fecha', 'ubicacions.nombre as ubicacion', DB::raw('SUM(volumen) as total_cantidad'), DB::raw('COUNT(ubicacions.nombre) as certificados'))
                ->join('ubicacions', 'ubicacions.id', '=', 'ubicacion_id')
                ->groupBy('ubicacions.nombre')
                ->whereYear('fecha', $selectedYear)
                ->whereMonth('fecha', $selectedMonth)
                ->get()
            ;
        }

        else if ($tipo == 'producto')
        {
            $resumen = Consolidado::select('fecha', 'productos.nombre as producto', DB::raw('SUM(volumen) as total_cantidad'), DB::raw('COUNT(productos.nombre) as certificados'))
                ->join('productos', 'productos.id', '=', 'producto_id')
                ->groupBy('productos.nombre')
                ->whereYear('fecha', $selectedYear)
                ->whereMonth('fecha', $selectedMonth)
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
        

        $pdf = Pdf::loadView('pdfs.resumen', ['mes_producto' => $mes_producto, 'mes_ubicacion' => $mes_ubicacion, 'ano_producto' => $ano_producto, 'ano_ubicacion' => $ano_ubicacion, 'resumen' => $resumen, 'fecha' => $fecha, 'tipo' => $tipo]);

        return $pdf->stream('resumen.pdf');
    }
}
