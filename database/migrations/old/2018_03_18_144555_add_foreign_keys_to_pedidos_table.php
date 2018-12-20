<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPedidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pedidos', function(Blueprint $table)
		{
			$table->foreign('clientes_id_cliente', 'fk_pedidos_clientes1')->references('id_cliente')->on('clientes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('empresas_id_empresa', 'fk_pedidos_empresas1')->references('id_empresa')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('pagamento_pedido_id_pagamento_pedido', 'fk_pedidos_pagamento_pedido1')->references('id_pagamento_pedido')->on('pagamento_pedido')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usuarios_id_usuario', 'fk_pedidos_usuarios1')->references('id_usuario')->on('usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pedidos', function(Blueprint $table)
		{
			$table->dropForeign('fk_pedidos_clientes1');
			$table->dropForeign('fk_pedidos_empresas1');
			$table->dropForeign('fk_pedidos_pagamento_pedido1');
			$table->dropForeign('fk_pedidos_usuarios1');
		});
	}

}
