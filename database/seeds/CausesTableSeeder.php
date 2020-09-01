<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CausesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('causes')->insert([


            [
                'causa'=> 'Inici Jornada Laboral',
                'tipus'=> 0,
                'mostra_grafic'=>0
            ],[
                'causa'=> 'Pausa Per a Dinar',
                'tipus'=> 1,
                'mostra_grafic'=>0
            ],[
                'causa'=> 'Inici Torn de Tarde',
                'tipus'=> 0,
                'mostra_grafic'=>0
            ],[
                'causa'=> 'Inici de Lot',
                'tipus'=> 0,
                'mostra_grafic'=>0
            ],[
                'causa'=> 'Màquina en Funcionament',
                'tipus'=> 0,
                'mostra_grafic'=>1
            ],[
                'causa'=> 'Avaria',
                'tipus'=> 1,
                'mostra_grafic'=>1
            ],[
                'causa'=> 'Parada personal',
                'tipus'=> 1,
                'mostra_grafic'=>1
            ],[
                'causa'=> 'Falta de Material',
                'tipus'=> 1,
                'mostra_grafic'=>1
            ],[
                'causa'=> 'Nou lot',
                'tipus'=> 1,
                'mostra_grafic'=>0
            ],[
                'causa'=> 'Neteja de màquina',
                'tipus'=> 1,
                'mostra_grafic'=>1
            ],[
                'causa'=> 'Fi de Lot',
                'tipus'=> 2,
                'mostra_grafic'=>0
            ],[
                'causa'=> 'Fi Jornada Laboral',
                'tipus'=> 2,
                'mostra_grafic'=>0
            ]
            ]
        );
    }
}
