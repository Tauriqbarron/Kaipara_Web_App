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
            'imagePath' => 'https://www.zones.co.nz/images/uploads/panoramas/mid-range-fence-pano-4.jpg',
            'title' => '200m fence',
            'description' => 'Fence required for a lifestyle property',
            'price' => 1000
        ]);
        $application->save();

        $application = new \App\applications([
            'imagePath' => 'https://www.slipperelectrical.co.nz/wp-content/uploads/2017/08/Residential-Electrician-Services.jpg',
            'title' => 'Power Outlet Relocation',
            'description' => 'Needing a power outlet moved about 5m',
            'price' => 300
        ]);
        $application->save();

        $application = new \App\applications([
            'imagePath' => 'https://s1.kaercher-media.com/image/pim/LMO_36_40_mowing_lawn_app_02_CI20.jpg?bp=lg',
            'title' => 'weekly lawn mowing',
            'description' => 'Needing lawns mowed every friday',
            'price' =>30
        ]);
        $application->save();
    }
}
