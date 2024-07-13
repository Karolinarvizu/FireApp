<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'crear reportes',
            'ver reportes',
            'actualizar reportes',
            'borrar reportes',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear roles y asignar permisos si no existen
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleAdmin->syncPermissions(Permission::all());

        $roleBombero = Role::firstOrCreate(['name' => 'bombero']);
        $roleBombero->syncPermissions(['crear reportes', 'ver reportes']);

        $roleComandante = Role::firstOrCreate(['name' => 'comandante']);
        $roleComandante->syncPermissions(Permission::all());

        $roleBombero = Role::firstOrCreate(['name' => 'bombero']);
        $roleBombero->syncPermissions(['crear reportes', 'ver reportes']);

        $roleGeneral = Role::firstOrCreate(['name' => 'usuario general']);
        $roleGeneral->syncPermissions(['ver reportes']);
    }
}

