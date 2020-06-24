<?php

use Illuminate\Database\Seeder;

class add_records_to_staff extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $staff = new \App\Staff([

            "first_name" =>  "Eva",
            "last_name" =>  "Dickens",
            "email" =>  "Michael.Botsford@gmail.com",
            "phone_number" => "(021)-8658451",
            "password" =>  Hash::make("hgKJJGbHgZpUQbx"),
            "street" =>  "123 Towne Island",
            "suburb" =>  "Fisherborough",
            "city" =>  "Bedfordshire",
            "postcode" =>  7045
        ]);
        $staff->save();

        $staff = new \App\Staff([

            "first_name" =>  "Noah",
            "last_name" =>  "Howell",
            "email" =>  "Nicholas77@gmail.com",
            "phone_number" => "(021)-8658451",
            "password" =>  Hash::make("DetMc7D9vR0FMGM"),
            "street" =>  "24946 Layla Drive",
            "suburb" =>  "East William",
            "city" =>  "Bedfordshire",
            "postcode" =>  9687
        ]);
        $staff->save();

        $staff = new \App\Staff([

            "first_name" =>  "Amber",
            "last_name" =>  "Davies",
            "email" =>  "Samantha_Hill41@gmail.com",
            "phone_number" => "(021)-8658451",
            "password" =>  Hash::make("zEhbfU33GKju_6f"),
            "street" =>  "8899 Green Court",
            "suburb" =>  "Williamsville",
            "city" =>  "Cambridgeshire",
            "postcode" =>  2883
        ]);
        $staff->save();

        $staff = new \App\Staff([

            "first_name" =>  "Ruby",
            "last_name" =>  "Carter",
            "email" =>  "Christian.Ryan@hotmail.com",
            "phone_number" => "(021)-8658451",
            "password" =>  Hash::make("QqZh4JvJnIDYEA7"),
            "street" =>  "110 Hickle Pass",
            "suburb" =>  "Russelhaven",
            "city" =>  "Avon",
            "postcode" =>  8632
        ]);
        $staff->save();

        $staff = new \App\Staff([

            "first_name" =>  "Isabella",
            "last_name" =>  "Langworth",
            "email" =>  "Paige.Cronin@gmail.com",
            "phone_number" => "(021)-8658451",
            "password" =>  Hash::make("gwDSlMx63Qzvjl4"),
            "street" =>  "083 Robinson Mall",
            "suburb" =>  "Caitlinberg",
            "city" =>  "Berkshire",
            "postcode" =>  7791
        ]);
        $staff->save();

        $staff = new \App\Staff([

            "first_name" =>  "Layla",
            "last_name" =>  "Brown",
            "email" =>  "Imogen.Ryan5@yahoo.com",
            "phone_number" => "(021)-8658451",
            "password" =>  Hash::make("v5VGf0OFOJoAUpY"),
            "street" =>  "37048 Connelly Parade",
            "suburb" =>  "Haneberg",
            "city" =>  "Avon",
            "postcode" =>  7925
        ]);
        $staff->save();
    }
}
