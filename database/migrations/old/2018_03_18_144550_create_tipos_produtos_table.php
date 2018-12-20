<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTiposProdutosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipos_produtos', function(Blueprint $table)
		{
			$table->integer('id_tipo_produto', true);
			$table->string('nome_tipo_produto', 20)->nullable();
			$table->string('descricao_tipo_produto', 20)->nullable();
			$table->boolean('status_tipo_produto')->nullable()->default(1);
			$table->integer('empresas_id_empresa')->index('fk_tipos_produtos_empresas1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipos_produtos');
	}

}
