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
        if(config('database.default') == 'mysql') \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Role::truncate();
        Permission::truncate();

        if(config('database.default') == 'mysql') \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $role = Role::create([
            'name' => config('constants.roles.geststock'),
            'home' => json_encode(['name' => 'stock.products.index', 'path' => 'stock/products', 'display' => 'Liste des produits'])
        ]);

        $role = Role::create([
            'name' => config('constants.roles.chgachat'),
            'home' => json_encode(['name' => 'achats.besoins.index', 'path' => 'achats/besoins', 'display' => 'Liste des bons de besoin'])
        ]);

        $permissionModule = Permission::create([
            'name' => 'show_module_page',
            'guard_name' => 'web',
            'display_name' => "Consulter la liste des modules"
        ]);

        $role = Role::create([
            'name' => config('constants.roles.dg'),
            'home' => json_encode(['name' => 'modules.index', 'path' => 'modules', 'display' => 'Liste des modules'])
        ]);

        $permission = Permission::create([
            'name' => 'Validate Besoin',
            'guard_name' => 'web',
            'display_name' => "Valider Bon d'expression de besoin"
        ]);

        $role->givePermissionTo($permission->name);
        $role->givePermissionTo($permissionModule->name);

        $role = Role::create([
            'name' => config('constants.roles.admin'),
            'home' => json_encode(['name' => 'admin.index', 'path' => 'admin', 'display' => 'Tableau de bord Administratif'])
        ]);

        $permission = Permission::create([
            'name' => 'Show Administration',
            'guard_name' => 'web',
            'display_name' => "Consulter l'administration"
        ]);

        $role->givePermissionTo($permission->name);
        $role->givePermissionTo($permissionModule->name);

        $role = Role::create([
            'name' => config('constants.roles.superadmin'),
            'home' => json_encode(['name' => 'admin.index', 'path' => 'admin', 'display' => 'Tableau de bord Administratif'])
        ]);
        $role->givePermissionTo($permission->name);
        $role->givePermissionTo($permissionModule->name);

        $permission = Permission::create([
            'name' => 'Admin Enterprises',
            'guard_name' => 'web',
            'display_name' => "Administrer les entreprises"
        ]);

        $role->givePermissionTo($permission->name);
        $role->givePermissionTo($permissionModule->name);

        foreach (config('constants.roles') as $key => $name) {
            if(!Role::whereName($name)->first()) {
                $role = Role::create([
                    'name' => $name,
                    'home' => json_encode(['name' => 'profile.index', 'path' => 'profile', 'display' => 'Mon compte'])
                ]);
                // $role->givePermissionTo($permissionModule->name);
            }
        }
    }
}
