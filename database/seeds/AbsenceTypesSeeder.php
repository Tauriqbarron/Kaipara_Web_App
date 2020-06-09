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
            'description' => 'Sick Leave'
        ]);
        $type->save();
        $type = new \App\Absence_Types([
            'description' => 'Maternity Leave'
        ]);
        $type->save();
    }
}
