<?php

namespace Database\Seeders;

use App\Models\Tickets;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Tickets::factory(10)->create();
    }
}
