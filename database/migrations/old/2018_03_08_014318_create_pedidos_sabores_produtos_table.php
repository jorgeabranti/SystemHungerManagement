<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePedidosSaboresProdutosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pedidos_sabores_produtos', function(Blueprint $table)
		{
			$table->integer('id_pedidos_sabores_produtos', true);
			$table->integer('id_item')->nullable();
			$table->integer('sabores_produtos_id_sabor_produto')->index('fk_pedidos_sabores_produtos_sabores_produtos1_idx');
			$table->integer('produtos_id_produto')->index('fk_pedidos_sabores_produtos_produtos1_idx');
			$table->integer('pedidos_id_pedido')->index('fk_pedidos_sabores_produtos_pedidos1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pedidos_sabores_produtos');
	}

}
