<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLloctreballsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lloctreballs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Descripcio');
            $table->float('Temps_Disponible');
            $table->float('Velocitat_esperada');
            $table->float('Temps_lectura');
            $table->float('obj_OEE');
            $table->float('obj_Disponibilitat');
            $table->float('obj_Rendiment');
            $table->float('obj_Qualitat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lloctreballs');
    }
}
