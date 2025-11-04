<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Super-Admin']);
        $rolAdmin = Role::create(['name' => 'Admin']);
        $rolConsolidado = Role::create(['name' => 'Consolidado']);
        $rolResumen = Role::create(['name' => 'Resumen']);
        

        Permission::create(['name' => 'consolidado.index'])->syncRoles([$rolAdmin, $rolConsolidado]);
        Permission::create(['name' => 'consolidado.create'])->syncRoles([$rolAdmin, $rolConsolidado]);
        Permission::create(['name' => 'consolidado.edit'])->syncRoles([$rolAdmin, $rolConsolidado]);
        Permission::create(['name' => 'consolidado.delete'])->syncRoles([$rolAdmin, $rolConsolidado]);

        Permission::create(['name' => 'resumen.index'])->syncRoles([$rolAdmin, $rolResumen]);
        Permission::create(['name' => 'resumen.pdf'])->syncRoles([$rolAdmin, $rolResumen]);
        Permission::create(['name' => 'resumen.fechas'])->syncRoles([$rolAdmin, $rolResumen]);

        Permission::create(['name' => 'users.index'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'users.create'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'users.edit'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'users.delete'])->syncRoles([$rolAdmin]);

        Permission::create(['name' => 'roles.index'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'roles.create'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'roles.edit'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'roles.delete'])->syncRoles([$rolAdmin]);
    }
}
