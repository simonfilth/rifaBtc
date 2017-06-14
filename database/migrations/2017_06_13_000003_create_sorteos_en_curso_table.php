<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSorteosEnCursoTable extends Migration
{
    /**
     * Run the migrations.
     * @table sorteos_en_curso
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorteos_en_curso', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('sorteo_id');
            $table->timestamps();


            $table->foreign('sorteo_id', 'sorteosencurso_sorteoid_foreign_idx')
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
       Schema::dropIfExists('sorteos_en_curso');
     }
}
