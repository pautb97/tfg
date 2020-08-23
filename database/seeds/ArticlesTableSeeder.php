<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            [
                'referencia'=>11111,
                'descripcio'=>'Lentrega es lo 28, espavil',
            ]
        ]);

    }
}
