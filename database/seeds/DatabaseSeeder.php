<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CausesTableSeeder::class);
         $this->call(EsdevenimentsTableSeeder::class);
         $this->call(ArticlesTableSeeder::class);
         $this->call(IndexsTableSeeder::class);
         $this->call(LloctreballsTableSeeder::class);
         $this->call(QualitatsTableSeeder::class);
    }
}
