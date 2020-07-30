<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freques', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('numero_peces');
            $table->unsignedInteger('numero_peces_sortint');
            $table->unsignedInteger('idESP');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('freques');
    }
}
