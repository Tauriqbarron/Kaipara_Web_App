<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staff = new \App\Staff([
            'first_name' => 'John',
            'last_name' => 'Wick',
            'email' => 'JohnW@gmail.com',
            'phone_number' => '(022)-4567891',
            'password' => Hash::make('JW3020'),
            'street' => '67  Caroni Way',
            'suburb' => 'Ohariu',
            'city' => 'Wellington',
            'postcode' => 6037
        ]);
        $staff->save();

        $staff = new \App\Staff([
            'first_name' => 'Bruce',
            'last_name' => 'Wayne',
            'email' => 'BruceW@gmail.com',
            'phone_number' => '(023)-4567890',
            'password' => Hash::make('BW0605'),
            'street' => '67  Caroni Way',
            'suburb' => 'Ohariu',
            'city' => 'Wellington',
            'postcode' => 6037
        ]);
        $staff->save();

        $staff = new \App\Staff([
            'first_name' => 'Burce',
            'last_name' => 'Li',
            'email' => 'BurceL@gmail.com',
            'phone_number' => '(021)-4567811',
            'password' => Hash::make('BL5689'),
            'street' => '67  Caroni Way',
            'suburb' => 'Ohariu',
            'city' => 'Wellington',
            'postcode' => 6037
        ]);
        $staff->save();

        $staff = new \App\Staff([
            'first_name' => 'Mike',
            'last_name' => 'Tyson',
            'email' => 'MikeT@gmail.com',
            'phone_number' => '(025)-0567891',
            'password' => Hash::make('MT1045'),
            'street' => '67  Caroni Way',
            'suburb' => 'Ohariu',
            'city' => 'Wellington',
            'postcode' => 6037
        ]);
        $staff->save();

        $staff = new \App\Staff([
            "first_name" => "Henry",
            "last_name" => "Kuhlman",
            "email" => "Christian.Kulas@hotmail.com",
            "password" => "wnYuYiLrjSGNTx8",
            "street" => "46331 Elizabeth Loop",
            "suburb" => "Port Anna",
            "city" => "Berkshire",
            "postcode" => 6270
        ]);
        $staff->save();


    }


}
