<?php

namespace App\Models;

use App\Traits\TracksCreacion;
use App\Traits\TracksEliminacion;
use Spatie\Permission\Models\Role as SpatieRole;

//Extendemos del modelo Role de spatie
class Role extends SpatieRole
{
    use TracksCreacion, TracksEliminacion;
}
