<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consums', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('intensitat_R');
            $table->unsignedInteger('intensitat_S');
            $table->unsignedInteger('intensitat_T');
            $table->unsignedInteger('potencia');
            $table->unsignedInteger('id_ESP');
        });
    }

    /**
     *
     *  Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consums');
    }
}
