<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProdutosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produtos', function(Blueprint $table)
		{
			$table->integer('id_produto', true);
			$table->string('nome_produto', 45)->nullable();
			$table->decimal('valor_unitario_produto', 10)->nullable();
			$table->string('descricao_produto', 200)->nullable();
			$table->integer('quant_sabores_produto')->nullable();
			$table->boolean('status_produto')->nullable()->default(1);
			$table->integer('tipos_produtos_id_tipo_produto')->index('fk_produtos_tipos_produtos1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('produtos');
	}

}
