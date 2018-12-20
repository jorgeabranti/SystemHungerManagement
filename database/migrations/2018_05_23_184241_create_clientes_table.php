<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clientes', function(Blueprint $table)
		{
			$table->integer('id_cliente', true);
			$table->integer('empresas_id_empresa')->index('fk_clientes_empresas1_idx');
			$table->string('nome_cliente', 100)->nullable();
			$table->string('cpf_cliente', 11)->nullable();
			$table->string('email_cliente', 100)->nullable();
			$table->string('cep_cliente', 10)->nullable();
			$table->string('endereco_cliente', 150)->nullable();
			$table->string('endereco_numero_cliente', 20)->nullable();
			$table->string('bairro_cliente', 50)->nullable();
			$table->string('cidade_cliente', 50)->nullable();
			$table->string('uf_cliente', 2)->nullable();
			$table->bigInteger('telefone_celular_cliente')->nullable();
			$table->bigInteger('telefone_residencial_cliente')->nullable();
			$table->string('genero_cliente', 10)->nullable();
			$table->string('id_rede_social_cliente', 20)->nullable();
			$table->string('distancia_endereco_km', 3)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clientes');
	}

}
