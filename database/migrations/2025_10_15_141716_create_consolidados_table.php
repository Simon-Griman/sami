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
            $table->string('cliente', 45);
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('segregacion_id');
            $table->string('destino', 45);
            $table->integer('volumen');
            $table->string('operacion', 45);
            $table->string('certificado');
            //$table->enum('borrado', [0, 1])->default('0');
            $table->softDeletes();
            $table->foreign('instalacion_id')->references('id')->on('instalacions')->onDelete('cascade');
            $table->foreign('ubicacion_id')->references('id')->on('ubicacions')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('segregacion_id')->references('id')->on('segregacions')->onDelete('cascade');
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
