<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service_provider = new \App\service_provider(
            [
                'firstname' => 'John',
                'lastname' => 'Storm',
                'username' => 'Jstorm',
                'email'=>'johnstorm@hotmail.co.nz',
                'password' => Hash::make('storm123') ,
                'phone_number'=>'(021)-3456782',
                'street' => '67  Caroni Way',
                'suburb' => 'Ohariu',
                'city' => 'Wellington',
                'postcode' => 6037
            ]
        );
        $service_provider ->save();
    }
}
