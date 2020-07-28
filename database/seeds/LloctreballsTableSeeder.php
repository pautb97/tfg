<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LloctreballsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            [
                'Temps_Disponible'=>15000,
                'Descripcio'=>'Hello',
                'Vellocitat_esperada'=>15,
                'obj_OEE'=>65,
                'obj_Disponibilitat'=>78,
                'obj_Rendiment'=>32,
                'obj_Qualitat'=>34
            ]
        ]);
    }
}
