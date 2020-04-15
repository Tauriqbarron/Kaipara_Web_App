<?php

use Illuminate\Database\Seeder;

class serviceproviderseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serviceprovider = new \App\serviceprovider(
        [
            'firstname' => 'John',
            'lastname' => 'Storm',
            'username' => 'Jstorm',
            'email'=>'johnstorm@hotmail.co.nz',
            'password' => 'storm123',
            'phone_number'=>'0213456782'
        ]
        );
        $serviceprovider ->save();
    }
}
