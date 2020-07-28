<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('ID_ordre');
            $table->unsignedInteger('index_disponibilitat');
            $table->unsignedInteger('index_rendiment');
            $table->unsignedInteger('index_qualitat');
            $table->unsignedInteger('index_oee');
            $table->unsignedInteger('unitats_defectuoses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oees');
    }
}
