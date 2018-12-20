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
			$table->string('login_usuario');
			$table->string('senha_usuario');
			$table->string('nome_usuario');
			$table->string('cpf_usuario', 11)->nullable();
			$table->integer('tipo_usuario');
			$table->boolean('status_usuario');
			$table->integer('empresas_id_empresa')->index('fk_usuarios_empresas1_idx');
			$table->dateTime('criado_em')->nullable();
			$table->dateTime('atualizado_em')->nullable();
			$table->string('token', 100)->nullable();
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
