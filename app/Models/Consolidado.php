<?php

namespace App\Models;

use App\Traits\TracksCreacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consolidado extends Model
{
    use HasFactory, TracksCreacion;

    protected $fillable = [
        'fecha',
        'instalacion_id',
        'ubicacion_id',
        'cliente',
        'producto_id',
        'segregacion_id',
        'destino',
        'volumen',
        'operacion',
        'certificado',
        'borrado',
        
    ];
}
