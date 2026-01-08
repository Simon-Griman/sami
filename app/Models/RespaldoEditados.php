<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespaldoEditados extends Model
{
    use HasFactory;

    protected $fillable = [
        'consolidado_id',
        'user_id',
        'ubicacion_id',
        'segregacion_id',
        'role_id',
        'cintillo_id',
        'campo',
        'valor_antes',
        'valor_despues',
        'batch_id',
    ];
}
