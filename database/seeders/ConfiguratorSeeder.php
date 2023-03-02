<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use App\Models\Configurator;
use App\Models\Module;

class ConfiguratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configurators = [
            [
                'type' => 'Window',
                'title' => 'Okno pionowe',
                'image' => '/photos/window.png',
                'description' => 'Nasze okna są trwałe i  ciepłe, chronią i zapewniają bezpieczeństwo. Okna mogą zostać wyposażone w antywłamaniowe szyby i okucia.',
                'button' => 'Skonfiguruj okno'
            ],
            [
                'type' => 'RollerBlind',
                'title' => 'Roleta',
                'image' => '/photos//rollerblind.png',
                'description' => 'Nasza roleta jest rozwiązaniem do zastosowań domowych, świetnie komponująca się z naszymi oknami.',
                'button' => 'Skonfiguruj roletę'
            ]
        ];
        //wyłączenie sprawdzania kluczy obcych
        Schema::disableForeignKeyConstraints();
        //usunięcie wszystkich rekordów z bazy
        Module::truncate();
        Configurator::truncate();
        //włączenie sprawdzania kluczy obcych
        Schema::enableForeignKeyConstraints();
        //pętla z dodaniem rekordów do bazy
        foreach ($configurators as $value){
            Configurator::create([
                'type' => $value['type'],
                'title' => $value['title'],
                'image' => $value['image'],
                'description' => $value['description'],
                'button' => $value['button']
            ]);
        }
    }
}
