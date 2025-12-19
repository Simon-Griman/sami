<?php

namespace App\Traits;

use App\Models\Cintillo;
use App\Models\RegistrosEliminados;
use App\Models\Respaldo;
use App\Models\Role;
use App\Models\Segregacion;
use App\Models\Ubicacion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait TracksEliminacion
{
    public static function bootTracksEliminacion()
    {
        static::deleted(function($model)
        {
            if (Auth::check())
            {
                RegistrosEliminados::create([
                    'user_id' => Auth::id(),
                    'model_type' => get_class($model),
                    'model_id' => $model->id,
                ]);

                if ($model instanceof Ubicacion)
                {
                    Respaldo::create([
                        'ubicacion_id' => $model->id,
                        'ubicacion' => $model->nombre,
                        'deleted_at' => now(),
                    ]);
                }

                elseif ($model instanceof Segregacion)
                {
                    Respaldo::create([
                        'segregacion_id' => $model->id,
                        'segregacion' => $model->nombre,
                        'deleted_at' => now(),
                    ]);
                }

                elseif ($model instanceof User)
                {
                    Respaldo::create([
                        'user_id' => $model->id,
                        'user' => $model->name,
                        'cedula' => $model->cedula,
                        'deleted_at' => now(),
                    ]);
                }

                elseif ($model instanceof Role)
                {
                    Respaldo::create([
                        'role_id' => $model->id,
                        'role' => $model->name,
                    ]);
                }

                elseif ($model instanceof Cintillo)
                {
                    Respaldo::create([
                        'cintillo_id' => $model->id,
                        'cintillo' => $model->nombre,
                    ]);
                }
            }
        });
    }
}