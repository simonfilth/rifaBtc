<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePremiosTerceroTable extends Migration
{
    /**
     * Run the migrations.
     * @table premios_tercero
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premios_tercero', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('sorteo_id');
            $table->unsignedInteger('usuario_id');
            $table->float('pago_tercero');
            $table->timestamps();


            $table->foreign('sorteo_id', 'premiostercero_sorteoid_foreign_idx')
                ->references('id')->on('sorteos')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('usuario_id', 'premiostercero_usuarioid_foreign_idx')
                ->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('premios_tercero');
     }
}