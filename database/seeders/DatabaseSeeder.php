<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(HomeSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(UnversitySeeder::class);
        $this->call(FakultySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DepartmentSeeder::class);
    }
}
