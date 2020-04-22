<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\Admin([
            'name' => 'Admin1',
            'email' => 'Admin1@admin.com',
            'password' => Hash::make('Admin123')
        ]);
        $admin->save();
    }
}
