<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\TypeFournisseursTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
    /*
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(TypeFournisseursTableSeeder::class);
        $this->command->info('Type fournisseur table seeded!');

        $this->call(MotifsTableSeeder::class);
        $this->command->info('Type fournisseur table seeded!');

        $this->call(LivreursTableSeeder::class);
        $this->command->info('Type fournisseur table seeded!');

        $this->call(TypeProductsTableSeeder::class);
        $this->command->info('Type fournisseur table seeded!');
        
        $this->call(ProductCategoriesTableSeeder::class);
        $this->command->info('Type fournisseur table seeded!');

        $this->call(TypeClientsTableSeeder::class);
        $this->command->info('Type fournisseur table seeded!');

        $this->call(FournisseursTableSeeder::class);
        $this->command->info('Type fournisseur table seeded!');

        $this->call(ClientsTableSeeder::class);
        $this->command->info('Type fournisseur table seeded!');

        
        
        $this->call(ProductsTableSeeder::class);
        $this->command->info('Type fournisseur table seeded!');
        
        /*$this->call(VariationsTableSeeder::class);
        $this->command->info('Type fournisseur table seeded!');*/
        
        $this->call(RolePermissionSeeder::class);
        $this->command->info('Roles and permissions tables seeded!');
        
        $this->call(UsersTableSeeder::class);
        $this->command->info('Users table seeded!');

        $this->call(EntreprisesTableSeeder::class);
        $this->command->info('Entreprise and entrepot table seeded!');
        
        $this->call(CategoriesTableSeeder::class);
        $this->command->info('Category table seeded!');

        $this->call(ParametresTableSeeder::class);
        $this->command->info('Parametre table seeded!');
        
        $this->call(ProductsTableSeeder::class);
        $this->command->info('Product and entrepots_has_products table seeded!');
        
        $this->call(MouvementsTableSeeder::class);
        $this->command->info('Mouvement and ligne_mouvement table seeded!');
    }
}
