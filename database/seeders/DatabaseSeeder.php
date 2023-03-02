<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ConfiguratorSeeder::class);
        $this->call(ModuleSeeder::class);
        $this->call(DiscountSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
