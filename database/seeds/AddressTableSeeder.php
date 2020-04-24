<?php

use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = new \App\Address([
            'street' => '67  Caroni Way',
            'suburb' => 'Ohariu',
            'city' => 'Wellington',
            'country' => 'New Zealand',
            'postcode' => 6037

        ]);
        $address->save();

        $address = new \App\Address([
            'street' => '278  Holmglen Street',
            'suburb' => 'Washdyke Flat',
            'city' => 'Auckland',
            'country' => 'New Zealand',
            'postcode' => 7910

        ]);
        $address->save();

        $address = new \App\Address([
            'street' => '97  Moffat Way',
            'suburb' => 'Motiti Island',
            'city' => 'Wellington',
            'country' => 'New Zealand',
            'postcode' => 3110

        ]);
        $address->save();
    }
}
