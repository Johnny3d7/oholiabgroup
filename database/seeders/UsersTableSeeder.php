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
        Employe::truncate();

        $user = User::create([
            'username' => "admin",
            'email'=> "admin@oholiab.com",
            'password' => Hash::make('1234567890'),
            // 'id_entreprise' => $entreprises[$i]
            'image' => 'images/faces/9.jpg'
        ]);
        $user->assignRole(config('constants.roles.admin'));

        $user = User::create([
            'username' => "sadmin",
            'email'=> "sadmin@oholiab.com",
            'password' => Hash::make('1234567890'),
            // 'id_entreprise' => $entreprises[$i]
            'image' => 'images/faces/10.jpg'
        ]);
        $user->assignRole(config('constants.roles.superadmin'));

        $employes = [
            // M. AKA Innocent - Gestionnaire des stocks
            collect([
                'civilite' => 'M',
                'nom' => 'AKA',
                'prenoms' => 'Innocent',
                'email' => 'i.aka@oholiabgroup.com',

                'username' => "geststock",
                'image' => 'storage/Profiles/Innocent-AKA-1.png',

                'role' => config('constants.roles.geststock')
            ]),

            // Mme AKOTTO Zélé - Responsable des achats
            collect([
                'civilite' => 'Mme',
                'nom' => 'AKOTTO',
                'prenoms' => 'Zélé',
                'email' => 'z.akotto@oholiabgroup.com',

                'username' => "chgachat",
                'image' => 'storage/Profiles/Zele-AKOTO.png',

                'role' => config('constants.roles.chgachat')
            ]),

            // Mme AKA-BADI Victorine - Administrateur général
            collect([
                'civilite' => 'Mme',
                'nom' => 'AKA-BADI',
                'prenoms' => 'Victorine',
                'email' => 'v.akabadi@oholiabgroup.com',

                'username' => "dg",
                'image' => 'storage/Profiles/Victorine-AKA.png',

                'role' => config('constants.roles.dg')
            ]),

            // M. SAKRÉ Armel - Reviseur comptable
            collect([
                'civilite' => 'M',
                'nom' => 'SAKRÉ',
                'prenoms' => 'Armel',
                'email' => 'a.sacre@oholiabgroup.com',

                'username' => "chefcomptable",
                'image' => 'storage/Profiles/Armel-SAKRE.png',

                'role' => config('constants.roles.chefcomptable')
            ]),

            // M. N'GUESSAN Manassé - Assistant comptable
            collect([
                'civilite' => 'M',
                'nom' => "N'GUESSAN",
                'prenoms' => 'Manassé',
                'email' => 'm.nguessan@oholiabgroup.com',

                'username' => "manasse",
                'image' => 'storage/Profiles/Manasse-NGUESSAN.png',

                'role' => config('constants.roles.comptable')
            ]),

            // Mme BAHI Ruth - Assistant comptable
            collect([
                'civilite' => 'Mme',
                'nom' => "BAHI",
                'prenoms' => 'Ruth',
                'email' => 'r.bahi@oholiabgroup.com',

                'username' => "ruth",
                'image' => 'storage/Profiles/Ruth-BAHI-1.png',

                'role' => config('constants.roles.comptable')
            ]),

            // Mme BADI Justine - Assistant de direction
            collect([
                'civilite' => 'Mme',
                'nom' => "BADI",
                'prenoms' => 'Justine',
                'email' => 'j.badi@oholiabgroup.com',

                'username' => "assist",
                'image' => 'storage/Profiles/Justine-BADI-1.png',

                'role' => config('constants.roles.ad')
            ]),

            // M. GNÉZIÉ Michel - Administrateur des ventes
            collect([
                'civilite' => 'M',
                'nom' => "GNÉZIÉ",
                'prenoms' => 'Michel',
                'email' => 'm.gnezie@oholiabgroup.com',

                'username' => "admvente",
                'image' => 'storage/Profiles/Michel-GNEZIE.png',

                'role' => config('constants.roles.admvente')
            ]),

            // Mme KOFFI Nahomie - Caissière
            collect([
                'civilite' => 'Mme',
                'nom' => "KOFFI",
                'prenoms' => 'Nahomie',
                'email' => 'n.koffi@oholiabgroup.com',

                'username' => "caissiere",
                'image' => 'storage/Profiles/Nahomie-KOFFI-1.png',

                'role' => config('constants.roles.caisse')
            ]),

            // M. BALOU Vivien - Directeur RH
            collect([
                'civilite' => 'M',
                'nom' => "BALOU",
                'prenoms' => 'Vivien',
                'email' => 'v.balou@oholiabgroup.com',

                'username' => "drh",
                'image' => 'storage/Profiles/DRH-Vivien-BALOU.png',

                'role' => config('constants.roles.drh')
            ]),

        ];

        foreach ($employes as $collection) {
            $collection = $collection->merge(['id_entreprises' => 1, 'contact' => '']);
            $employe = Employe::create($collection->only('civilite', 'nom', 'prenoms', 'email', 'contact', 'id_entreprises')->all());

            $collection = $collection->merge(['id_employes' => $employe->id, 'password' => Hash::make('1234567890')]);
            $user = User::create($collection->only('email', 'password', 'username', 'image', 'id_employes')->all());

            $user->assignRole($collection->get('role'));
        }

        /*
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
            'id_employes' => $employe->id,
            'image' => 'storage/Profiles/aka-innocent.png'
        ]);

        $user->assignRole('Gestionnaire de Stocks');

        $employe = Employe::create([
                'civilite' => 'Mme',
            'nom' => 'AKOTTO',
            'prenoms' => 'Zélé',
            'contact' => '',
            'email' => 'z.akotto@oholiabgroup.com',
            'id_entreprises' => 1,
        ]);

        $user = User::create([
            'username' => "chgachat",
            'email'=> "chgachat@oholiab.com",
            'password' => Hash::make('1234567890'),
            'id_employes' => $employe->id,
            'image' => 'storage/Profiles/akotto.png'
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
            'id_employes' => $employe->id,
            'image' => 'storage/Profiles/mme-aka.png'
        ]);

        $user->assignRole('Directrice Générale');

        $employe = Employe::create([
                'civilite' => 'M.',
            'nom' => 'Sacré',
            'prenoms' => 'comptable',
            'contact' => '',
            'email' => 'sacre@oholiabgroup.com',
            'id_entreprises' => 1,
        ]);

        $user = User::create([
            'username' => "comptable",
            'email'=> "sacre@oholiab.com",
            'password' => Hash::make('1234567890'),
            'id_employes' => $employe->id,
            'image' => 'storage/Profiles/mme-aka.png'
        ]);

        $user->assignRole('Comptable');

        $employe = Employe::create([
                'civilite' => 'M.',
            'nom' => 'Sacré',
            'prenoms' => 'Armel',
            'contact' => '',
            'email' => 'sacre@oholiabgroup.com',
            'id_entreprises' => 1,
        ]);

        $user = User::create([
            'username' => "comptable",
            'email'=> "sacre@oholiab.com",
            'password' => Hash::make('1234567890'),
            'id_employes' => $employe->id,
            'image' => 'storage/Profiles/mme-aka.png'
        ]);

        $user->assignRole('Chef comptable');

        $user = User::create([
            'username' => "admin",
            'email'=> "admin@oholiab.com",
            'password' => Hash::make('1234567890'),
            // 'id_entreprise' => $entreprises[$i]
            'image' => 'images/faces/9.jpg'
        ]);

        $user->assignRole('admin');

        $user = User::create([
            'username' => "sadmin",
            'email'=> "sadmin@oholiab.com",
            'password' => Hash::make('1234567890'),
            // 'id_entreprise' => $entreprises[$i]
            'image' => 'images/faces/10.jpg'
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
