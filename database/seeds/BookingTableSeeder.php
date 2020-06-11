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
            'price' => 300,
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
            'description' => 'Wedding Security',
            'price' => 150,
            'street' => '205  Argyle Street',
            'suburb' => 'Kew',
            'city' => 'Invercargill',
            'postcode' => 9812,
            'date' => today('NZ')->addDays(1),
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
            'price' => 350,
            'street' => '97  Industry Road',
            'suburb' => 'Onehunga',
            'city' => 'Auckland',
            'postcode' => 1061,
            'date' => today('NZ')->addDays(2),
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
            'price' => 250,
            'street' => '67  Farmhouse Lane',
            'suburb' => 'Meadowbank',
            'city' => 'Auckland',
            'postcode' => 1072,
            'date' => today('NZ')->addDays(3),
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
            'price' => 190,
            'street' => '194  Curran Street',
            'suburb' => 'Freemans Bay',
            'city' => 'Auckland',
            'postcode' => 1011,
            'date' => today('NZ')->addDays(2),
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
            'price' => 200,
            'street' => '97  Industry Road',
            'suburb' => 'Onehunga',
            'city' => 'Auckland',
            'postcode' => 1061,
            'date' => today('NZ')->addDays(1),
            'start_time' => 14.00,
            'finish_time'=> 22.00,
            'staff_needed' => 1,
            'available_slots' => 1,
        ]);
        $booking->save();

    }
}
