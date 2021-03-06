<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntregadoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entregadores', function(Blueprint $table)
		{
			$table->integer('id_entregador', true);
			$table->string('nome_entregador', 45);
			$table->string('placa_entregador', 10)->nullable();
			$table->string('cpf_entregador', 11);
			$table->integer('empresas_id_empresa')->index('fk_entregadores_empresas1_idx');
			$table->boolean('status_entregador')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entregadores');
	}

}
