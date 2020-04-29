<?php

use Illuminate\Database\Seeder;

class BookingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $booking = new \App\Booking([
            'client_id' => 1,
            'booking_type_id' => 1,
            'description' => 'Bouncer',
            'address_id' => 3,
            'date' => today(),
            'start_time' => '14:00'

        ]);
        $booking->save();

        $booking = new \App\Booking([
            'client_id' => 2,
            'booking_type_id' => 2,
            'description' => 'Wedding Security',
            'address_id' => 1,
            'date' => today(),
            'start_time' => '08:00'

        ]);
        $booking->save();

        $booking = new \App\Booking([
            'client_id' => 3,
            'booking_type_id' => 3,
            'description' => 'Security',
            'address_id' => 2,
            'date' => today(),
            'start_time' => '06:00'
        ]);
        $booking->save();

    }
}
