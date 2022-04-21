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
        \App\Models\Profession::factory(3)->create();
        \App\Models\County::factory(3)->create();
        \App\Models\Department::factory(3)->create();
    }
}
