<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespaldoEditadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respaldo_editados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consolidado_id')->nullable()->constrained();
            $table->foreignId('ubicacion_id')->nullable()->constrained();
            $table->foreignId('segregacion_id')->nullable()->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('cintillo_id')->nullable()->constrained();
            $table->foreignId('role_id')->nullable()->constrained();
            $table->string('campo');
            $table->text('valor_antes')->nullable();
            $table->text('valor_despues')->nullable();
            $table->string('batch_id')->nullable();
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
        Schema::dropIfExists('respaldo_editados');
    }
}
