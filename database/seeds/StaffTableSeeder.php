<?php

use Illuminate\Database\Seeder;

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
            'phone_number' => '1234567891',
            'password' => Hash::make('JW3020')
        ]);
        $staff->save();

        $staff = new \App\Staff([
            'first_name' => 'Bruce',
            'last_name' => 'Wayne',
            'email' => 'BruceW@gmail.com',
            'phone_number' => '1234567890',
            'password' => Hash::make('BW0605')
        ]);
        $staff->save();

        $staff = new \App\Staff([
            'first_name' => 'Burce',
            'last_name' => 'Li',
            'email' => 'BurceL@gmail.com',
            'phone_number' => '1234567811',
            'password' => Hash::make('BL5689')
        ]);
        $staff->save();

        $staff = new \App\Staff([
            'first_name' => 'Mike',
            'last_name' => 'Tyson',
            'email' => 'MikeT@gmail.com',
            'phone_number' => '1230567891',
            'password' => Hash::make('MT1045')
        ]);
        $staff->save();
    }
}
