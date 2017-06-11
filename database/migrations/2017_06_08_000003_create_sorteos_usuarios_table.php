<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSorteosUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     * @table sorteos_usuarios
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorteos_usuarios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('sorteo_id');
            $table->unsignedInteger('usuario_id');
            $table->string('id_transferencia');
            $table->unsignedTinyInteger('confirmar_pago')->default('0');

            $table->unique(["id_transferencia"], 'unique_sorteos_usuarios');
            $table->timestamps();


            $table->foreign('usuario_id', 'sorteosusuarios_usuarioid_foreign_idx')
                ->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('sorteo_id', 'sorteosusuarios_sorteoid_foreign_idx')
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
       Schema::dropIfExists('sorteos_usuarios');
     }
}
