<?php

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
        $this->call(SchoolsTableSeeder::class);
        $this->call(NotesTabelSeeder::class);
        $this->call(UsersTabelSeeder::class);
        $this->call(AdminsTabelSeeder::class);
    }
}
