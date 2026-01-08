<?php

namespace App\Traits;

use App\Models\Consolidado;
use App\Models\Instalacion;
use App\Models\Producto;
use App\Models\RegistrosEditados;
use App\Models\RespaldoEditados;
use App\Models\Segregacion;
use App\Models\Ubicacion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait TracksEdicion
{
    public static function bootTracksEdicion()
    {
        static::updated(function($model)
        {
            $cambios = $model->getChanges();
            unset($cambios['updated_at']);

            if (empty($cambios)) return;

            $batchId = (string) \Illuminate\Support\Str::uuid();

            if (Auth::check())
            {
                RegistrosEditados::create([
                    'user_id' => Auth::id(),
                    'model_type' => get_class($model),
                    'model_id' => $model->id,
                    'batch_id' => $batchId,
                ]);
            }

            else return;

            foreach ($cambios as $key => $value)
            {
                $antes = $model->getOriginal($key);

                if ($model instanceof Consolidado)
                {
                    if ($key == 'instalacion_id')
                    {
                        $valorAntes = Instalacion::find($antes)->nombre;
                        $valorDespues = Instalacion::find($value)->nombre;
                        $campo = 'Instalación';
                    }

                    elseif ($key == 'ubicacion_id')
                    {
                        $valorAntes = Ubicacion::find($antes)->nombre;
                        $valorDespues = Ubicacion::find($value)->nombre;
                        $campo = 'Ubicación';
                    }

                    elseif ($key == 'producto_id')
                    {
                        $valorAntes = Producto::find($antes)->nombre;
                        $valorDespues = Producto::find($value)->nombre;
                        $campo = 'Producto';
                    }

                    elseif ($key == 'segregacion_id')
                    {
                        $valorAntes = Segregacion::find($antes)->nombre;
                        $valorDespues = Segregacion::find($value)->nombre;
                        $campo = 'Segregacion';
                    }

                    else
                    {
                        $valorAntes = $antes;
                        $valorDespues = $value;
                        $campo = $key;
                    }

                    RespaldoEditados::create([
                        'consolidado_id' => $model->id,
                        'batch_id' => $batchId,
                        'campo' => $campo,
                        'valor_antes' => $valorAntes,
                        'valor_despues' => $valorDespues,
                    ]);
                }

                elseif ($model instanceof Ubicacion)
                {
                    RespaldoEditados::create([
                        'ubicacion_id' => $model->id,
                        'batch_id' => $batchId,
                        'campo' => $key,
                        'valor_antes' => $antes,
                        'valor_despues' => $value,
                    ]);
                }

                elseif ($model instanceof Segregacion)
                {
                    RespaldoEditados::create([
                        'segregacion_id' => $model->id,
                        'batch_id' => $batchId,
                        'campo' => $key,
                        'valor_antes' => $antes,
                        'valor_despues' => $value,
                    ]);
                }
            }
        });
    }
}