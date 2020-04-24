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
        //$this->call(StaffTableSeeder::class);
        //$this->call(AdminTableSeeder::class);
        $this->call(ServiceSeeder::class);
        //$this->call(applicationsTableSeeder::class);

    }
}
