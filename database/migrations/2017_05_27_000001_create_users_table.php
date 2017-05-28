<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('apellido');
            $table->string('email');
            $table->string('password', 60);
            $table->string('tipo_usuario', 20)->default('Cliente');
            $table->string('id_wallet');
            $table->string('remember_token', 100)->nullable()->default('null');

            $table->unique(["email", "id_wallet"], 'unique_users');
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
       Schema::dropIfExists('users');
     }
}
