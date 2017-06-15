<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSorteosTable extends Migration
{
    /**
     * Run the migrations.
     * @table sorteos
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorteos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('fecha_sorteo')->nullable();
            $table->float('precio_sorteo')->nullable();
            $table->time('hora_sorteo')->nullable();
            $table->string('estado_sorteo', 45)->default('No realizado');
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
       Schema::dropIfExists('sorteos');
     }
}
