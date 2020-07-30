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
               'Descripcio'=>'dades estatiques',
                'Temps_Disponible'=>28800,
                'Velocitat_esperada'=>15,
                'Temps_lectura'=>60,
                'obj_OEE'=>70,
                'obj_Disponibilitat'=>70,
                'obj_Rendiment'=>70,
                'obj_Qualitat'=>70,
                'inici_jornada_laboral'=>'2020-07-30 07:15:09',
                'final_jornada_laboral'=>'2020-07-30 23:17:00',
            ]
        ]);
    }
}
