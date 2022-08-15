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
         \App\Models\User::factory(1)->create();
         //\App\Models\Datalistrik::factory(12)->create();
         //\App\Models\Token::factory(12)->create();

    }
}
