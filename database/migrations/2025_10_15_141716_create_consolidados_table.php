<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsolidadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consolidados', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->unsignedBigInteger('instalacion_id');
            $table->unsignedBigInteger('ubicacion_id');
            $table->string('cliente');
            $table->unsignedBigInteger('producto_id');
            $table->string('segregacion');
            $table->string('destino');
            $table->foreign('instalacion_id')->references('id')->on('instalacions')->onDelete('cascade');
            $table->foreign('ubicacion_id')->references('id')->on('ubicacions')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consolidados');
    }
}
