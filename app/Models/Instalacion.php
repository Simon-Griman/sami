<?php

namespace App\Models;

use App\Traits\TracksCreacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalacion extends Model
{
    use HasFactory, TracksCreacion;

    protected $fillable = [
        'nombre'
    ];
}
