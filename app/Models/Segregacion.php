<?php

namespace App\Models;

use App\Traits\TracksCreacion;
use App\Traits\TracksEliminacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segregacion extends Model
{
    use HasFactory, TracksCreacion, TracksEliminacion;

    protected $fillable = [
        'nombre',
        'hidrocarburo',
    ];
}
