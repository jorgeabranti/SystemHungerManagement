<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmpresasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresas', function(Blueprint $table)
		{
			$table->integer('id_empresa', true);
			$table->string('razao_social', 100)->nullable();
			$table->string('nome_fantasia', 100)->nullable();
			$table->string('cnpj_empresa', 18)->nullable();
			$table->timestamp('data_cadastro')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('id_page_empresa', 45)->nullable();
			$table->boolean('utilizar_taxa_fixa')->nullable()->default(0);
			$table->decimal('taxa_fixa_entrega', 10)->nullable();
			$table->decimal('taxa_km_entrega', 10)->nullable();
			$table->boolean('status_empresa')->nullable()->default(1);
			$table->string('endereco_empresa', 150)->nullable();
			$table->string('endereco_numero_empresa', 20)->nullable();
			$table->string('cep_empresa', 10)->nullable();
			$table->string('bairro_empresa', 50)->nullable();
			$table->string('cidade_empresa', 50)->nullable();
			$table->string('uf_empresa', 2)->nullable();
			$table->bigInteger('telefone1_empresa')->nullable();
			$table->bigInteger('telefone2_empresa')->nullable();
			$table->bigInteger('telefone3_empresa')->nullable();
			$table->bigInteger('telefone4_empresa')->nullable();
			$table->string('logo_img', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('empresas');
	}

}
