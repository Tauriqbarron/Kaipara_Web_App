<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisrationController extends Controller
{
    public function createServiceProvider($input){
        $user = new \App\ServiceProvider(
            [
                'firstname' => 'John',
                'lastname' => 'Storm',
                'username' => 'Jstorm',
                'email'=>'johnstorm@hotmail.co.nz',
                'password' => 'storm123',
                'phone_number'=>'0213456782'
            ]
        );
    }
}
