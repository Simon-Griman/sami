<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeVolumenToDecimalInConsolidadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consolidados', function (Blueprint $table) {
            $table->decimal('volumen', 8, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('decimal_in_consolidados', function (Blueprint $table) {
            $table->integer('volumen')->change();
        });
    }
}
