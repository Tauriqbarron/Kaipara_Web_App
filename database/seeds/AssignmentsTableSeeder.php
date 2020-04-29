<?php

use Illuminate\Database\Seeder;

class AssignmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assignment = new \App\Assignment([
            'status' => 'assigned',
            'booking_id'=> 1
        ]);
        $assignment->save();

        $assignment = new \App\Assignment([
            'status' => 'assigned',
            'booking_id'=> 2
        ]);
        $assignment->save();

        $assignment = new \App\Assignment([
            'status' => 'assigned',
            'booking_id'=> 3
        ]);
        $assignment->save();
    }
}
