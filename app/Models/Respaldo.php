<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respaldo extends Model
{
    use HasFactory;

    protected $table = 'respaldo_registros';

    protected $fillable = [
        'user_id',
        'user',
        'cedula',
        'ubicacion_id',
        'ubicacion',
        'segregacion_id',
        'segregacion',
        'role_id',
        'role',
        'cintillo_id',
        'cintillo',
        'deleted_at',
    ];
}
