<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EtudiantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('etudiants')->delete();
        \DB::table('etudiants')->insert(array(
            0 => array(
                'id' => 1,
                'user_id' => 2,
                'classe_id' => 1
            ),
            1 => array(
                'id' => 2,
                'user_id' => 3,
                'classe_id' => 1
            )
        ));
    }
}
