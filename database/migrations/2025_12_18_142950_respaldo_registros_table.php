<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RespaldoRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respaldo_registros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user')->nullable();
            $table->string('cedula')->nullable();
            $table->unsignedBigInteger('ubicacion_id')->nullable();
            $table->string('ubicacion')->nullable();
            $table->unsignedBigInteger('segregacion_id')->nullable();
            $table->string('segregacion')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('role')->nullable();
            $table->unsignedBigInteger('cintillo_id')->nullable();
            $table->string('cintillo')->nullable();
            $table->timestamp('deleted_at');
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
        Schema::dropIfExists('respaldo_registros');
    }
}
