<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discount;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discounts = [
            [
                'discount_code' => '6DBD0FE19C9A',
                'discount_type' => 'Percent',
                'amount' => '30',
                'active' => 'Y'
            ],
            [
                'discount_code' => '301C470828778',
                'discount_type' => 'Value',
                'amount' => '250',
                'active' => 'Y'
            ]
        ];
        
        //usunięcie wszystkich rekordów z bazy
        Discount::truncate();

        //pętla z dodaniem rekordów do bazy
        foreach ($discounts as $value){
            Discount::create([
                'discount_code' => $value['discount_code'],
                'discount_type' => $value['discount_type'],
                'amount' => $value['amount'],
                'active' => $value['active']
            ]);
        }
    }
}
