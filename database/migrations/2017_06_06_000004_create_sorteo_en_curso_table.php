<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSorteoEnCursoTable extends Migration
{
    /**
     * Run the migrations.
     * @table sorteos_vigentes
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorteo_en_curso', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('rifa_id');
            $table->timestamps();


            $table->foreign('rifa_id', 'sorteoencurso_rifaid_foreign_idx')
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
       Schema::dropIfExists('sorteo_en_curso');
     }
}
