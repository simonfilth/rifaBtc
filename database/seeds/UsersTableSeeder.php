<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert(array (
	        'name' => "Simón José",
	        'apellido' => "Aguilera Gómez",
	        'email' => "admin@admin.com",
	        'password' => \Hash::make('admin'),
	        'remember_token' => str_random(10),
	        'tipo_usuario' => 'Administrador',
	        'id_wallet' => 'wallet',
	        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
		));

		\DB::table('otros_datos_usuario')->insert(array (
	        'usuario_id' => 1,
	        'foto_perfil' => "default-profile-pic.png",
	        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
		));

		$contents = \Storage::get('default-profile-pic.png');
        \Storage::put('1/foto_perfil/default-profile-pic.png', $contents);
    }
}
//php artisan make:seeder UsersTableSeeder
//php artisan db:seed --class=UsersTableSeeder