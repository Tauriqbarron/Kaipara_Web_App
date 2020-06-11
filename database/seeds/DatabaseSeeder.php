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
        /*
        $this->call(AdminTableSeeder::class);
        $this->call(StaffTableSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(BookingTypesTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        */
        $this->call(applicationsTableSeeder::class);
        $this->call(BookingTableSeeder::class);
        $this->call(StaffAssignmentSeeder::class);
        $this->call(BookingTypesTableSeeder::class);
        $this->call(add_completed_assignments_and_timesheets::class);
        $this->call(AbsenceTypesSeeder::class);
        $this->call(AbsenceStatusSeeder::class);



    }
}
