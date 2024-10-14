<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassarosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passaros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anilha_id');
            $table->unsignedBigInteger('cor_id');
            $table->unsignedBigInteger('especie_id');
            $table->unsignedBigInteger('situacao_id');
            $table->string('nome');
            $table->char('sexo',1);
            $table->string('imagem');
            $table->timestamps();


            $table->foreign('anilha_id')->references('id')->on('anilhas');
            $table->foreign('cor_id')->references('id')->on('cors');
            $table->foreign('especie_id')->references('id')->on('especies');
            $table->foreign('situacao_id')->references('id')->on('situacaos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passaros');
    }
}
