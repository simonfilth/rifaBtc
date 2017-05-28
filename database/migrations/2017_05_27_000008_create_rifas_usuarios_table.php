<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRifasUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     * @table rifas_usuarios
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rifas_usuarios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('rifa_id');
            $table->unsignedInteger('usuario_id');
            $table->string('id_transferencia');
            $table->unsignedTinyInteger('confirmar_pago')->default('0');

            $table->unique(["id_transferencia"], 'unique_rifas_usuarios');
            $table->timestamps();


            $table->foreign('usuario_id', 'rifasusuarios_usuarioid_foreign_idx')
                ->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('rifa_id', 'rifasusuarios_rifaid_foreign_idx')
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
       Schema::dropIfExists('rifas_usuarios');
     }
}
