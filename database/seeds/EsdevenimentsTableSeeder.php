<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class EsdevenimentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('esdeveniments')->insert([
            [
                'ID_causa'=>1,
                'modul_temps'=>34,
                'maquina_produccio'=>1
            ],[
                'ID_causa'=>4,
                'modul_temps'=>23,
                'maquina_produccio'=>1
            ],[
                'ID_causa'=>7,
                'modul_temps'=>43,
                'maquina_produccio'=>1
            ],[
                'ID_causa'=>5,
                'modul_temps'=>53,
                'maquina_produccio'=>1
            ],[
                'ID_causa'=>7,
                'modul_temps'=>45,
                'maquina_produccio'=>1
            ],[
                'ID_causa'=>2,
                'modul_temps'=>25,
                'maquina_produccio'=>1
            ],[
                'ID_causa'=>1,
                'modul_temps'=>34,
                'maquina_produccio'=>1
            ],[
                'ID_causa'=>4,
                'modul_temps'=>23,
                'maquina_produccio'=>1
            ],[
                'ID_causa'=>7,
                'modul_temps'=>43,
                'maquina_produccio'=>1
            ],[
                'ID_causa'=>5,
                'modul_temps'=>53,
                'maquina_produccio'=>1
            ],[
                'ID_causa'=>7,
                'modul_temps'=>45,
                'maquina_produccio'=>1
            ],[
                'ID_causa'=>2,
                'modul_temps'=>25,
                'maquina_produccio'=>1
            ]
            ]
        );
    }
}
