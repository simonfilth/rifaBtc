<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtrosDatosUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     * @table otros_datos_usuario
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otros_datos_usuario', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('usuario_id');
            $table->string('foto_perfil')->nullable();
            $table->timestamps();


            $table->foreign('usuario_id', 'otrosdatosusuarios_usuarioid_foreign_idx')
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
       Schema::dropIfExists('otros_datos_usuario');
     }
}
