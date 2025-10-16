<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consolidado extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'instalacion_id',
        'ubicacion_id',
        'cliente',
        'producto_id',
        'segregacion',
        'destino',
        'borrado',
        
    ];
}
