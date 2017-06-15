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
            $table->unsignedInteger('sorteo_id');
            $table->unsignedInteger('usuario_id');
            $table->unsignedTinyInteger('lugar');
            $table->float('pago');
            $table->timestamps();


            $table->foreign('sorteo_id', 'ganadores_sorteoid_foreign_idx')
                ->references('id')->on('sorteos')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('usuario_id', 'ganadores_usuarioid_foreign_idx')
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
       Schema::dropIfExists('ganadores');
     }
}
