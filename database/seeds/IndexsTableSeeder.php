<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndexsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indexs')->insert([
            [
                'OEE'=>80,
                'Disponibilitat'=>60,
                'Rendiment'=>70,
                'Qualitat'=>35
            ],[
                'OEE'=>84,
                'Disponibilitat'=>50,
                'Rendiment'=>73,
                'Qualitat'=>34
            ],[
                'OEE'=>50,
                'Disponibilitat'=>30,
                'Rendiment'=>10,
                'Qualitat'=>45
            ],[
                'OEE'=>44,
                'Disponibilitat'=>34,
                'Rendiment'=>45,
                'Qualitat'=>56
            ],[
                'OEE'=>56,
                'Disponibilitat'=>45,
                'Rendiment'=>34,
                'Qualitat'=>34
            ],[
                'OEE'=>78,
                'Disponibilitat'=>65,
                'Rendiment'=>54,
                'Qualitat'=>89
            ]
            ]
        );
    }
}
