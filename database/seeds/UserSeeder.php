<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sentinel::register([
            'id' => 1,
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '12345678',
        ],true);

        Sentinel::register([
            'id' => 2,
            'first_name' => 'user',
            'last_name' => 'user',
            'email' => 'user@user.com',
            'password' => '12345678',
        ],true);

    }
}
