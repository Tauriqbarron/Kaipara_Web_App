<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new \App\Clients([
            'first_name' => 'Everett',
            'last_name' => 'Volkman',
            'email' => 'pk6tnhwuz0n@groupbuff.com',
            'phone_number' => '(020) 1807-878',
            'password' => Hash::make('Admin123'),
            'address_id' => 1

        ]);
        $client->save();

        $client = new \App\Clients([
            'first_name' => 'Duane',
            'last_name' => 'Reyes',
            'email' => 'duane.reyes@example.com',
            'phone_number' => '(167)-814-6525',
            'password' => Hash::make('disney'),
            'address_id' => 1

        ]);
        $client->save();

        $client = new \App\Clients([
            'first_name' => 'Candyce',
            'last_name' => 'Payne',
            'email' => 'candyce.payne@example.com',
            'phone_number' => '(099)-970-3459',
            'password' => Hash::make('chilli'),
            'address_id' => 2

        ]);
        $client->save();

        $client = new \App\Clients([
            'first_name' => 'Leo',
            'last_name' => 'Gilbert',
            'email' => 'leo.gilbert@example.com',
            'phone_number' => '(000)-406-3920',
            'password' => Hash::make('weston'),
            'address_id' => 3

        ]);
        $client->save();
    }
}
