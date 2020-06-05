<?php

use Illuminate\Database\Seeder;

class add_completed_assignments_and_timesheets extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create new bookings with old dates
        $booking = new \App\Booking([
            'client_id' => 1,
            'booking_type_id' => 1,
            'description' => '(Completed Bookings Test) Bouncer',
            'street' => '67  Caroni Way',
            'suburb' => 'Ohariu',
            'city' => 'Wellington',
            'postcode' => 6037,
            'date' => today('NZ'),
            'start_time' => 6.30,
            'finish_time'=> 14.30,
            'staff_needed' => 2,
            'available_slots' => 2,
            'status' => 'assigned'

        ]);
        $booking->save();

        $booking = new \App\Booking([
            'client_id' => 2,
            'booking_type_id' => 2,
            'description' => '(Completed Bookings Test) Wedding Security',
            'street' => '205  Argyle Street',
            'suburb' => 'Kew',
            'city' => 'Invercargill',
            'postcode' => 9812,
            'date' => today('NZ')->addDays(-1),
            'start_time' => 6.00,
            'finish_time'=> 14.00,
            'staff_needed' => 2,
            'available_slots' => 2,
            'status' => 'assigned'

        ]);
        $booking->save();

        $booking = new \App\Booking([
            'client_id' => 3,
            'booking_type_id' => 3,
            'description' => '(Completed Bookings Test) Security',
            'street' => '97  Industry Road',
            'suburb' => 'Onehunga',
            'city' => 'Auckland',
            'postcode' => 1061,
            'date' => today('NZ')->addDays(-2),
            'start_time' => 8.30,
            'finish_time'=> 16.30,
            'staff_needed' => 2,
            'available_slots' => 2,
            'status' => 'assigned'
        ]);
        $booking->save();

        $booking = new \App\Booking([
            'client_id' => 1,
            'booking_type_id' => 1,
            'description' => '(Completed Bookings Test) Bouncer',
            'street' => '67  Farmhouse Lane',
            'suburb' => 'Meadowbank',
            'city' => 'Auckland',
            'postcode' => 1072,
            'date' => today('NZ')->addDays(-3),
            'start_time' => 8.00,
            'finish_time'=> 16.00,
            'staff_needed' => 1,
            'available_slots' => 1,

        ]);
        $booking->save();

        $booking = new \App\Booking([
            'client_id' => 2,
            'booking_type_id' => 2,
            'description' => '(Completed Bookings Test) Wedding Security',
            'street' => '194  Curran Street',
            'suburb' => 'Freemans Bay',
            'city' => 'Auckland',
            'postcode' => 1011,
            'date' => today('NZ')->addDays(-2),
            'start_time' => 14.30,
            'finish_time'=> 22.30,
            'staff_needed' => 1,
            'available_slots' => 1,

        ]);
        $booking->save();

        $booking = new \App\Booking([
            'client_id' => 3,
            'booking_type_id' => 3,
            'description' => '(Completed Bookings Test) Security',
            'street' => '97  Industry Road',
            'suburb' => 'Onehunga',
            'city' => 'Auckland',
            'postcode' => 1061,
            'date' => today('NZ')->addDays(-1),
            'start_time' => 14.00,
            'finish_time'=> 22.00,
            'staff_needed' => 1,
            'available_slots' => 1,
        ]);
        $booking->save();

        //Assign bookings to test staff member
        $staff_assignment = new \App\Staff_Assignment(
            [
                'staff_id'=>1,
                'booking_id'=>7
            ]
        );
        $staff_assignment ->save();
        $staff_assignment = new \App\Staff_Assignment(
            [
                'staff_id'=>1,
                'booking_id'=>8
            ]
        );
        $staff_assignment ->save();
        $staff_assignment = new \App\Staff_Assignment(
            [
                'staff_id'=>1,
                'booking_id'=>9
            ]
        );
        $staff_assignment ->save();
        $staff_assignment = new \App\Staff_Assignment(
            [
                'staff_id'=>1,
                'booking_id'=>10
            ]
        );
        $staff_assignment ->save();
        $staff_assignment = new \App\Staff_Assignment(
            [
                'staff_id'=>1,
                'booking_id'=>11
            ]
        );
        $staff_assignment ->save();
        $staff_assignment = new \App\Staff_Assignment(
            [
                'staff_id'=>1,
                'booking_id'=>12
            ]
        );
        $staff_assignment ->save();
        //Add Timesheets to staff assignments
        $timesheet = new \App\Timesheet(
            [
                'date' => today('NZ'),
                'start_time' => 6.30,
                'stop_time'=> 14.30,
                'staff__assignment_id'=> 4
            ]
        );
        $timesheet->save();
        $timesheet = new \App\Timesheet(
            [
                'date' => today('NZ')->addDays(-1),
                'start_time' => 6.00,
                'stop_time'=> 14.00,
                'staff__assignment_id'=> 5
            ]
        );
        $timesheet->save();
        $timesheet = new \App\Timesheet(
            [
                'date' => today('NZ')->addDays(-2),
                'start_time' => 8.30,
                'stop_time'=> 16.30,
                'staff__assignment_id'=> 6
            ]
        );
        $timesheet->save();
        $timesheet = new \App\Timesheet(
            [
                'date' => today('NZ')->addDays(-3),
                'start_time' => 8.00,
                'stop_time'=> 16.00,
                'staff__assignment_id'=> 7
            ]
        );
        $timesheet->save();
        $timesheet = new \App\Timesheet(
            [
                'date' => today('NZ')->addDays(-2),
                'start_time' => 14.30,
                'stop_time'=> 22.30,
                'staff__assignment_id'=> 8
            ]
        );
        $timesheet->save();
        $timesheet = new \App\Timesheet(
            [
                'date' => today('NZ')->addDays(-1),
                'start_time' => 14.00,
                'stop_time'=> 22.00,
                'staff__assignment_id'=> 9
            ]
        );
        $timesheet->save();

    }
}
