<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        Permission::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $role = Role::create([
            'name' => 'Gestionnaire de Stocks',
        ]);
        
        $role = Role::create([
            'name' => "Chargé d'Achats",
        ]);

        $role = Role::create([
            'name' => 'Directrice Générale',
        ]);

        $permission = Permission::create([
            'name' => 'Validate Besoin',
            'guard_name' => 'web',
            'display_name' => "Valider Bon d'expression de besoin"
        ]);

        $role->givePermissionTo($permission->name);

        $role = Role::create([
            'name' => 'admin',
        ]);

        $permission = Permission::create([
            'name' => 'Show Aministration',
            'guard_name' => 'web',
            'display_name' => "Consulter l'administration"
        ]);

        $role->givePermissionTo($permission->name);

        $role = Role::create([
            'name' => 'superadmin',
        ]);
        $role->givePermissionTo($permission->name);

        $permission = Permission::create([
            'name' => 'Admin Enterprises',
            'guard_name' => 'web',
            'display_name' => "Administrer les entreprises"
        ]);

        $role->givePermissionTo($permission->name);
    }
}
