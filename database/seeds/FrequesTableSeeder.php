<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FrequesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('freques')->insert([
            [
                'numero_peces'=> 7
            ],[
                'numero_peces'=> 7
            ],[
                'numero_peces'=> 6
            ],[
                'numero_peces'=> 7
            ],[
                'numero_peces'=> 9
            ],[
                'numero_peces'=> 15
            ],[
                'numero_peces'=> 15
            ],[
                'numero_peces'=> 34
            ],[
                'numero_peces'=> 5
            ],[
                'numero_peces'=> 6
            ],[
                'numero_peces'=> 1
            ],[
                'numero_peces'=> 1
            ],[
                'numero_peces'=> 9
            ],[
                'numero_peces'=> 6
            ],[
                'numero_peces'=> 7
            ],[
                'numero_peces'=> 7
            ],[
                'numero_peces'=> 7
            ],[
                'numero_peces'=> 6
            ],[
                'numero_peces'=> 7
            ],[
                'numero_peces'=> 7
            ],[
                'numero_peces'=> 7
            ]
            ]
        );
    }
}
