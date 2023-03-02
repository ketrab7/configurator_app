<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idWindow = DB::table('configurators')->where('type', '=', 'Window')->first()->id;
        $idRollerBlind = DB::table('configurators')->where('type', '=', 'RollerBlind')->first()->id;

        $modules = [
            [
                'configuratorID' => $idWindow,
                'type' => 'integer',
                'name' => 'width',
                'title' => 'Szerokość [mm]',
                'information' => 'Podaj szerokość w milimetrach.',
                'value' => 'np.550',
                'priceFactor' => '1.5'
            ],
            [
                'configuratorID' => $idWindow,
                'type' => 'integer',
                'name' => 'height',
                'title' => 'Wysokość [mm]',
                'information' => 'Podaj wysokość w milimetrach.',
                'value' => 'np.1000',
                'priceFactor' => '1.5'
            ],
            [
                'configuratorID' => $idWindow,
                'type' => 'select',
                'name' => 'glassPackage',
                'title' => 'Pakiet szybowy',
                'information' => '',
                'value' => 'jednokomorowa;dwukomorowa;trzykomorowa',
                'priceFactor' => '1.25'
            ],
            [
                'configuratorID' => $idWindow,
                'type' => 'select',
                'name' => 'frameInGlassPackage',
                'title' => 'Ramka w pakiecie szybowym',
                'information' => '',
                'value' => 'stalowa (zimna); TGI (ciepła)',
                'priceFactor' => '1.15'
            ],
            [
                'configuratorID' => $idWindow,
                'type' => 'select',
                'name' => 'TypeHinges',
                'title' => 'Rodzaj zawiasów',
                'information' => '',
                'value' => 'widoczne;ukryte',
                'priceFactor' => '1'
            ],
            [
                'configuratorID' => $idWindow,
                'type' => 'select',
                'name' => 'typeOfHandle',
                'title' => 'Rodzaj klamki',
                'information' => '',
                'value' => 'standardowa; secure- z możliwością zamknięcia na klucz',
                'priceFactor' => '1'
            ],
            [
                'configuratorID' => $idWindow,
                'type' => 'select',
                'name' => 'handleColour',
                'title' => 'Kolor klamki',
                'information' => '',
                'value' => 'biały;srebrny;złoty',
                'priceFactor' => '1'
            ],
            [
                'configuratorID' => $idWindow,
                'type' => 'text',
                'name' => 'additionalOptions',
                'title' => 'Dodatkowe uwagi',
                'information' => 'W przypadku dodatkowych uwag.',
                'value' => '...',
                'priceFactor' => '1'
            ],
            [
                'configuratorID' => $idRollerBlind,
                'type' => 'integer',
                'name' => 'width',
                'title' => 'Szerokość [mm]',
                'information' => 'Podaj szerokość w milimetrach.',
                'value' => 'np.550',
                'priceFactor' => '1.5'
            ],
            [
                'configuratorID' => $idRollerBlind,
                'type' => 'integer',
                'name' => 'height',
                'title' => 'Wysokość [mm]',
                'information' => 'Podaj wysokość w milimetrach.',
                'value' => 'np.1000',
                'priceFactor' => '1.5'
            ],
            [
                'configuratorID' => $idRollerBlind,
                'type' => 'select',
                'name' => 'type',
                'title' => 'Typ',
                'information' => '',
                'value' => 'zwykła;dzień/noc',
                'priceFactor' => '1.15'
            ],
            [
                'configuratorID' => $idRollerBlind,
                'type' => 'select',
                'name' => 'controlType',
                'title' => 'Sterowanie',
                'information' => '',
                'value' => 'ręczne;elektryczne;WiFi',
                'priceFactor' => '1.15'
            ],
            [
                'configuratorID' => $idRollerBlind,
                'type' => 'select',
                'name' => 'color',
                'title' => 'Kolor tkaniny',
                'information' => '',
                'value' => 'biały;beżowy;brązowy;czarny;czerwony;fioletowy;niebieski;pomarańczowy;różowy;szary;zielony;żółty',
                'priceFactor' => '1.15'
            ]
        ];
        //pętla z dodaniem rekordów do bazy
        foreach ($modules as $value){
            Module::create([
                'configuratorID' => $value['configuratorID'],
                'type' => $value['type'],
                'name' => $value['name'],
                'title' => $value['title'],
                'information' => $value['information'],
                'value' => $value['value'],
                'priceFactor' => $value['priceFactor']
            ]);
        }
    }
}
