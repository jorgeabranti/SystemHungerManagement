<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSaboresProdutosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sabores_produtos', function(Blueprint $table)
		{
			$table->integer('id_sabor_produto', true);
			$table->string('nome_sabor_produto', 45)->nullable();
			$table->string('descricao_sabor_produto', 45)->nullable();
			$table->boolean('status_sabor_produto')->nullable();
			$table->integer('tipos_produtos_id_tipo_produto')->index('fk_sabores_produtos_tipos_produtos1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sabores_produtos');
	}

}
