<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagamentosPedidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pagamentos_pedidos', function(Blueprint $table)
		{
			$table->integer('id_pagamento_pedido', true);
			$table->dateTime('data_pagamento_pedido')->nullable();
			$table->decimal('valor_pago', 10)->nullable();
			$table->string('bandeira_cartao', 20)->nullable();
			$table->string('id_transacao', 45)->nullable();
			$table->integer('formas_pagamento_empresa_id_forma_pagamento_empresa')->index('fk_pagamento_pedido_formas_pagamento_empresa1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pagamentos_pedidos');
	}

}
