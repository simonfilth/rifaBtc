<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGanadoresTable extends Migration
{
    /**
     * Run the migrations.
     * @table ganadores
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ganadores', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('sorteo_usuario_id');
            $table->unsignedTinyInteger('lugar');
            $table->float('pago');
            $table->timestamps();


            $table->foreign('sorteo_usuario_id', 'ganadores_sorteousuarioid_foreign_idx')
                ->references('id')->on('sorteos_usuarios')
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
       Schema::dropIfExists('ganadores');
     }
}
