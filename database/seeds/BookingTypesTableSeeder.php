<?php

use Illuminate\Database\Seeder;

class BookingTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $booking_type = new \App\Booking_Types([
            'description' => 'Bouncer',

        ]);
        $booking_type->save();

        $booking_type = new \App\Booking_Types([
            'description' => 'Commissioned Officer',

        ]);
        $booking_type->save();

        $booking_type = new \App\Booking_Types([
            'description' => 'Non-Commisioned Officer',

        ]);
        $booking_type->save();

        $booking_type = new \App\Booking_Types([
            'description' => 'Remote CCTV Monitor',

        ]);
        $booking_type->save();

        $booking_type = new \App\Booking_Types([
            'description' => 'Uniformed Security',

        ]);
        $booking_type->save();
    }
}
