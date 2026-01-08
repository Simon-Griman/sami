<?php

namespace App\Models;

use App\Traits\TracksCreacion;
use App\Traits\TracksEdicion;
use App\Traits\TracksEliminacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consolidado extends Model
{
    use HasFactory, SoftDeletes, TracksCreacion, TracksEliminacion, TracksEdicion;

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
