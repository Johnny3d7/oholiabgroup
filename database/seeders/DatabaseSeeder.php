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

        $this->call(EntreprisesTableSeeder::class);
        $this->command->info('Type fournisseur table seeded!');

        $this->call(UsersTableSeeder::class);
        $this->command->info('Type fournisseur table seeded!');

        $this->call(ProductsTableSeeder::class);
        $this->command->info('Type fournisseur table seeded!');

        /*$this->call(VariationsTableSeeder::class);
        $this->command->info('Type fournisseur table seeded!');*/
    }
}
