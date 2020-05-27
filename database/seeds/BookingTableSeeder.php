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
            'street' => '67  Caroni Way',
            'suburb' => 'Ohariu',
            'city' => 'Wellington',
            'postcode' => 6037,
            'date' => '2020-05-26 00:00:00',
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
            'description' => 'Wedding Security',
            'street' => '205  Argyle Street',
            'suburb' => 'Kew',
            'city' => 'Invercargill',
            'postcode' => 9812,
            'date' => '2020-05-27 00:00:00',
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
            'description' => 'Security',
            'street' => '97  Industry Road',
            'suburb' => 'Onehunga',
            'city' => 'Auckland',
            'postcode' => 1061,
            'date' => '2020-05-28 00:00:00',
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
            'description' => 'Bouncer',
            'street' => '67  Farmhouse Lane',
            'suburb' => 'Meadowbank',
            'city' => 'Auckland',
            'postcode' => 1072,
            'date' => '2020-05-29 00:00:00',
            'start_time' => 8.00,
            'finish_time'=> 16.00,
            'staff_needed' => 1,
            'available_slots' => 1,

        ]);
        $booking->save();

        $booking = new \App\Booking([
            'client_id' => 2,
            'booking_type_id' => 2,
            'description' => 'Wedding Security',
            'street' => '194  Curran Street',
            'suburb' => 'Freemans Bay',
            'city' => 'Auckland',
            'postcode' => 1011,
            'date' => '2020-05-28 00:00:00',
            'start_time' => 14.30,
            'finish_time'=> 22.30,
            'staff_needed' => 1,
            'available_slots' => 1,

        ]);
        $booking->save();

        $booking = new \App\Booking([
            'client_id' => 3,
            'booking_type_id' => 3,
            'description' => 'Security',
            'street' => '97  Industry Road',
            'suburb' => 'Onehunga',
            'city' => 'Auckland',
            'postcode' => 1061,
            'date' => '2020-05-27 00:00:00',
            'start_time' => 14.00,
            'finish_time'=> 22.00,
            'staff_needed' => 1,
            'available_slots' => 1,
        ]);
        $booking->save();

    }
}
