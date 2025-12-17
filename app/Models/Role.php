<?php

namespace App\Models;

use App\Traits\TracksCreacion;
use Spatie\Permission\Models\Role as SpatieRole;

//Extendemos del modelo Role de spatie
class Role extends SpatieRole
{
    use TracksCreacion;
}
