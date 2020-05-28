<?php

use Illuminate\Database\Seeder;

class applicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $application = new \App\applications([
            'client_id'=>'1',
            'status'=> '1',
            'imagePath' => 'https://www.zones.co.nz/images/uploads/panoramas/mid-range-fence-pano-4.jpg',
            'title' => '200m fence',
            'description' => 'Fence required for a lifestyle property',
            'price' => 1000,
            'street' => '67  Caroni Way',
            'suburb' => 'Ohariu',
            'city' => 'Wellington',
            'postcode' => 6037
        ]);
        $application->save();

        $application = new \App\applications([
            'client_id'=>'2',
            'status'=> '1',
            'imagePath' => 'https://www.slipperelectrical.co.nz/wp-content/uploads/2017/08/Residential-Electrician-Services.jpg',
            'title' => 'Power Outlet Relocation',
            'description' => 'Needing a power outlet moved about 5m',
            'price' => 300,
            'street' => '67  Caroni Way',
            'suburb' => 'Ohariu',
            'city' => 'Wellington',
            'postcode' => 6037
        ]);
        $application->save();

        $application = new \App\applications([
            'client_id'=>'3',
            'status'=> '1',
            'imagePath' => 'https://s1.kaercher-media.com/image/pim/LMO_36_40_mowing_lawn_app_02_CI20.jpg?bp=lg',
            'title' => 'weekly lawn mowing',
            'description' => 'Needing lawns mowed every friday',
            'price' =>30,
            'street' => '67  Caroni Way',
            'suburb' => 'Ohariu',
            'city' => 'Wellington',
            'postcode' => 6037
        ]);
        $application->save();
        $application = new \App\applications([
            'status'=> '1',
            'imagePath' => 'https://www.gardenmagiclandscaping.com/uploads/7/6/8/0/76808997/edited/westmount-pathway_7.jpg',
            'title' => '5 Meter Paving',
            'description' => 'small path to be paved from door to street',
            'price' =>null,
            'street' => '67  Caroni Way',
            'suburb' => 'Ohariu',
            'city' => 'Wellington',
            'postcode' => 6037
        ]);
        $application->save();
    }
}
