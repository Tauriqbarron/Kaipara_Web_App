<?php

use Illuminate\Database\Seeder;

class AbsenceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new \App\Absence_Status([
            'description' => 'Pending'
        ]);
        $status->save();
        $status = new \App\Absence_Status([
            'description' => 'Approved'
        ]);
        $status->save();
        $status = new \App\Absence_Status([
            'description' => 'Declined'
        ]);
        $status->save();
    }
}
