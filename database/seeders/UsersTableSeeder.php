<?php

namespace Database\Seeders;

use App\Models\Employe;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::truncate();

        $employe = Employe::create([
            'civilite' => 'M',
            'nom' => 'AKA',
            'prenoms' => 'Innocent',
            'contact' => '',
            'email' => 'i.aka@oholiabgroup.com',
            'id_entreprises' => 1,
        ]);

        $user = User::create([
            'username' => "geststock",
            'email'=> "geststock@oholiab.com",
            'password' => Hash::make('1234567890'),
            'id_employes' => $employe->id
        ]);

        $user->assignRole('Gestionnaire de Stocks');
        
        $employe = Employe::create([
            'civilite' => 'Mme',
            'nom' => 'AKOTO',
            'prenoms' => 'Zélé',
            'contact' => '',
            'email' => 'z.akoto@oholiabgroup.com',
            'id_entreprises' => 1,
        ]);

        $user = User::create([
            'username' => "chgachat",
            'email'=> "chgachat@oholiab.com",
            'password' => Hash::make('1234567890'),
            'id_employes' => $employe->id
        ]);

        $user->assignRole("Chargé d'Achats");
        
        $employe = Employe::create([
            'civilite' => 'Mme',
            'nom' => 'AKA',
            'prenoms' => 'dg',
            'contact' => '',
            'email' => 'aka@oholiabgroup.com',
            'id_entreprises' => 1,
        ]);

        $user = User::create([
            'username' => "dg",
            'email'=> "dg@oholiab.com",
            'password' => Hash::make('1234567890'),
            'id_employes' => $employe->id
        ]);

        $user->assignRole('Directrice Générale');
        
        $user = User::create([
            'username' => "admin",
            'email'=> "admin@oholiab.com",
            'password' => Hash::make('1234567890'),
            // 'id_entreprise' => $entreprises[$i]
        ]);

        $user->assignRole('admin');
        
        $user = User::create([
            'username' => "sadmin",
            'email'=> "sadmin@oholiab.com",
            'password' => Hash::make('1234567890'),
            // 'id_entreprise' => $entreprises[$i]
        ]);

        $user->assignRole('superadmin');

        /*

        $name= [
            'oholiab',
            'akebie',
            'obpinc'
        ];

        $email= [
            'oholiab@gmail.com',
            'akebie@gmail.com',
            'obpinc@gmail.com'
        ];

        $entreprises = [
            1,
            2,
            3
        ];

        for ($i = 0; $i < 3; $i++) {
            User::create([
                'username' => $name[$i],
                'email'=> $email[$i],
                'password' => Hash::make('1234567890'),
                'id_entreprise' => $entreprises[$i]
            ]);

        }*/
    }
}
