<?php

namespace Database\Seeders;

use App\Models\ParcInfo\Device;
use App\Models\ParcInfo\EmployeHasDevice;
use App\Models\ParcInfo\TypeDevice;
use Illuminate\Database\Seeder;

class ParcInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(config('database.default') == 'mysql') \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        EmployeHasDevice::truncate();
        TypeDevice::truncate();
        Device::truncate();

        if(config('database.default') == 'mysql') \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        TypeDevice::create([
            // 'reference' => ,
            'libelle' => "Ordinateur Portable",
            'image' => "storage/Categories/laptop.png",
            'description' => "Un ordinateur portable est un appareil informatique compact et portable qui peut être facilement transporté d'un endroit à l'autre. Les ordinateurs portables sont livrés avec des caractéristiques telles qu'un écran, un clavier, un processeur, une mémoire et un disque dur. Ils sont alimentés par une batterie rechargeable qui peut durer de plusieurs heures à un jour ou plus, selon le type d'ordinateur portable et les applications exécutées. Les ordinateurs portables peuvent être utilisés pour jouer à des jeux, communiquer avec d'autres personnes via Internet, regarder des films et bien plus encore.",
            'observations' => "",
        ]);

        TypeDevice::create([
            // 'reference' => ,
            'libelle' => "Tablette Graphique",
            'image' => "storage/Categories/tablet.jpg",
            'description' => "Une tablette graphique est un périphérique informatique qui permet aux utilisateurs d'interagir avec l'ordinateur à l'aide d'un stylet ou d'un stylet spécialisé. Elles sont généralement utilisées pour le dessin et le montage photo/vidéo, et pour les jeux vidéo. Les tablettes graphiques sont constituées d'un écran tactile, d'un stylet et d'une surface plane sur laquelle l'utilisateur peut dessiner ou écrire. Certaines tablettes sont également équipées d'un stylet spécialisé pour la 3D et peuvent être utilisées pour le jeu et le dessin. La plupart des tablettes sont disponibles avec une variété d'options de résolution et de précision, et peuvent être connectées à un PC, un ordinateur Mac ou une console de jeux.",
            'observations' => "",
        ]);

        Device::factory()
            ->count(12)
            ->create();

    }
}
