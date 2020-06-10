<?php

use Illuminate\Database\Seeder;

class AbsenceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new \App\Absence_Types([
            'description' => 'Annual Leave'
        ]);
        $type->save();
        $type = new \App\Absence_Types([
            'description' => 'Lieu Day'
        ]);
        $type->save();
        $type = new \App\Absence_Types([
            'description' => 'Study Leave'
        ]);
        $type->save();
    }
}
