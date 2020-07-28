<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
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
            'title'=> 'Historic',
            'slug'=> 'historic',
            'content'=>'Pàgina Històric'
        ],[
            'title'=> 'Login',
            'slug'=> 'login',
            'content'=>'Pàgina Login'
        ],[
            'title'=> 'Aturades',
            'slug'=> 'aturades',
            'content'=>'Pagina Aturades'
        ],[
            'title'=> 'Principal',
            'slug'=>'principal',
            'content'=>'Pantalla Principal'
        ],[
            'title'=> 'Teclat',
            'slug'=> 'teclat',
            'content'=>'Pagina Teclat'
        ],[
            'title'=> 'Static',
            'slug'=>'static',
            'content'=>'Pàgina Static'
        ]
        ]
    );
    }
}
