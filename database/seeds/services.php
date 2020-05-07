<?php

use Illuminate\Database\Seeder;

class services extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = new \App\services(['description'=>'Plumbing']);
        $service->save();
        $service = new \App\services(['description'=>'Electrical']);
        $service->save();
        $service = new \App\services(['description'=>'Landscaping']);
        $service->save();
    }
}
