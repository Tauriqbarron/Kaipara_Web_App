<?php

use Illuminate\Database\Seeder;

class StaffAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staff_assignment = new \App\Staff_Assignment(
            [
                'staff_id'=>1,
                'assignment_id'=>1
            ]
        );
        $staff_assignment ->save();
        $staff_assignment = new \App\Staff_Assignment(
            [
                'staff_id'=>1,
                'assignment_id'=>2
            ]
        );
        $staff_assignment ->save();
        $staff_assignment = new \App\Staff_Assignment(
            [
                'staff_id'=>1,
                'assignment_id'=>3
            ]
        );
        $staff_assignment ->save();

    }
}
