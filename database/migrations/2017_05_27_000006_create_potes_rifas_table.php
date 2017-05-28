<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePotesRifasTable extends Migration
{
    /**
     * Run the migrations.
     * @table potes_rifas
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potes_rifas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('rifa_id');
            $table->float('total_pote');
            $table->timestamps();


            $table->foreign('rifa_id', 'potesrifas_rifaid_foreign_idx')
                ->references('id')->on('rifas')
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
       Schema::dropIfExists('potes_rifas');
     }
}
