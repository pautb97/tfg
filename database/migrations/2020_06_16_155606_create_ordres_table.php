<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordres', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('ID_article');
            $table->unsignedInteger('unitats_produir');
            $table->unsignedInteger('unitats_produides')->nullable();
            $table->unsignedInteger('frequencia_produccio')->nullable();
            $table->unsignedInteger('unitats_defectuoses')->nullable();
            $table->timestamp('data_hora_final')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordres');
    }
}
