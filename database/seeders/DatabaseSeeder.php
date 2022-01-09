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
        $this->call(FTableSeeder::class);
        $this->call(TTableSeeder::class);
        $this->call(ZTableSeeder::class);
        $this->call(DataSeeder::class);
        $this->call(MomentSeeder::class);
        $this->call(UjiAnavaSeeder::class);
        $this->call(UjiTSeeder::class);
    }
}
