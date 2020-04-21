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
                'phone_number'=>'0213456782'
            ]
        );
        $service_provider ->save();
    }
}
