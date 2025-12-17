<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrosCreados extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'model_type',
        'model_id',
    ];

    public function getModelNameAttribute()
    {
        $fullClass = $this->attributes['model_type'];

        return basename(str_replace('\\', '/', $fullClass));
    }
}
