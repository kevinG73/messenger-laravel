<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClasseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('classes')->delete();
        \DB::table('classes')->insert(array(
            0 => array(
                'id' => 1,
                'nom' => 'Licence 1'
            ),
            1 => array(
                'id' => 2,
                'nom' => 'Licence 2'
            ),
            2 => array(
                'id' => 3,
                'nom' => 'Licence 3'
            ),
            3 => array(
                'id' => 4,
                'nom' => 'Master 1'
            )
        ));
    }
}
