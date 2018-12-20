<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios', function(Blueprint $table)
		{
			$table->integer('id_usuario', true);
			$table->string('login_usuario', 45)->nullable();
			$table->string('senha_usuario', 45)->nullable();
			$table->string('nome_usuario', 45)->nullable();
			$table->string('cpf_usuario', 11)->nullable();
			$table->integer('tipo_usuario')->nullable();
			$table->boolean('status_usuario')->nullable();
			$table->integer('empresas_id_empresa')->index('fk_usuarios_empresas1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuarios');
	}

}
