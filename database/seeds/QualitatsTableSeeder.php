<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class QualitatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('qualitats')->insert([
            [
                'defectuoses'=> 0
            ],[
                'defectuoses'=> 3
            ],[
                'defectuoses'=> 34
            ],[
                 'defectuoses'=> 6
            ],[
                'defectuoses'=> 0
            ],[
                'defectuoses'=> 10
            ]
            ]
        );
    }
}
