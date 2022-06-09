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
            'home' => json_encode(['name' => 'stock.products.index', 'path' => 'stock/products', 'display' => 'Liste des produits'])
        ]);
        
        $role = Role::create([
            'name' => "Chargé d'Achats",
            'home' => json_encode(['name' => 'achats.besoins.index', 'path' => 'achats/besoins', 'display' => 'Liste des bons de besoin'])
        ]);

        $permissionModule = Permission::create([
            'name' => 'show_module_page',
            'guard_name' => 'web',
            'display_name' => "Consulter la liste des modules"
        ]);

        $role = Role::create([
            'name' => 'Directrice Générale',
            'home' => json_encode(['name' => 'module.index', 'path' => 'modules', 'display' => 'Liste des modules'])
        ]);

        $permission = Permission::create([
            'name' => 'Validate Besoin',
            'guard_name' => 'web',
            'display_name' => "Valider Bon d'expression de besoin"
        ]);

        $role->givePermissionTo($permission->name);
        $role->givePermissionTo($permissionModule->name);

        $role = Role::create([
            'name' => 'admin',
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
            'name' => 'superadmin',
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
    }
}
