<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        \DB::table('users')->insert(array(
            0 => array(
                'id' => 1,
                'first_name' => 'guelade',
                'last_name' => 'kevin',
                'email' => 'kevinguelade@gmail.com',
                'tel' => '0708863719',
                'password' => bcrypt('123456'),
                'role_id' => 2
            ),
            1 => array(
                'id' => 2,
                'first_name' => 'Boly',
                'last_name' => 'yannick',
                'tel' => '0779702135',
                'email' => 'ivanboly.yb@gmail.com',
                'password' => bcrypt('123456'),
                'role_id' => 1
            )
        ));
    }
}
