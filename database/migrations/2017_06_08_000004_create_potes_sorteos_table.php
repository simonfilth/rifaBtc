<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePotesSorteosTable extends Migration
{
    /**
     * Run the migrations.
     * @table potes_sorteos
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potes_sorteos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('sorteo_id');
            $table->float('total_pote');
            $table->timestamps();


            $table->foreign('sorteo_id', 'potessorteos_sorteoid_foreign_idx')
                ->references('id')->on('sorteos')
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
       Schema::dropIfExists('potes_sorteos');
     }
}
