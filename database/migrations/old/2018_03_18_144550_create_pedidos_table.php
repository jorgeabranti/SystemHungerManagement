<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePedidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pedidos', function(Blueprint $table)
		{
			$table->integer('id_pedido', true);
			$table->boolean('status_pedido')->nullable();
			$table->decimal('taxa_entrega_pedido', 10,2)->nullable()->default(0)->change();
			$table->timestamp('data_pedido')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('data_ultimo_status_pedido')->nullable();
			$table->decimal('total_valor_pedido', 10,2)->nullable()->default(0)->change();
			$table->integer('usuarios_id_usuario')->index('fk_pedidos_usuarios1_idx');
			$table->integer('clientes_id_cliente')->index('fk_pedidos_clientes1_idx');
			$table->integer('pagamento_pedido_id_pagamento_pedido')->index('fk_pedidos_pagamento_pedido1_idx');
			$table->integer('empresas_id_empresa')->index('fk_pedidos_empresas1_idx');
		});
                
                
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pedidos');
	}

}
