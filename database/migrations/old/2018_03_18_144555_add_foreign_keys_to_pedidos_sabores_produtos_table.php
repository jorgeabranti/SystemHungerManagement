<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPedidosSaboresProdutosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pedidos_sabores_produtos', function(Blueprint $table)
		{
			$table->foreign('pedidos_id_pedido', 'fk_pedidos_sabores_produtos_pedidos1')->references('id_pedido')->on('pedidos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('produtos_id_produto', 'fk_pedidos_sabores_produtos_produtos1')->references('id_produto')->on('produtos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('sabores_produtos_id_sabor_produto', 'fk_pedidos_sabores_produtos_sabores_produtos1')->references('id_sabor_produto')->on('sabores_produtos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pedidos_sabores_produtos', function(Blueprint $table)
		{
			$table->dropForeign('fk_pedidos_sabores_produtos_pedidos1');
			$table->dropForeign('fk_pedidos_sabores_produtos_produtos1');
			$table->dropForeign('fk_pedidos_sabores_produtos_sabores_produtos1');
		});
	}

}
