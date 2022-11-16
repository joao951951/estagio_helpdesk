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
        $this->call([
            TypeuserSeeder::class,
            StatusSeeder::class,
            UserSeeder::class,
            PrioritySeeder::class
            /* ClientSeeder::class,
            EmployeeSeeder::class */
        ]);
    }
}
