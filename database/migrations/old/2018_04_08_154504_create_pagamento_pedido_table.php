<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagamentoPedidoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pagamento_pedido', function(Blueprint $table)
		{
			$table->integer('id_pagamento_pedido', true);
			$table->dateTime('data_pagamento_pedido')->nullable();
			$table->decimal('valor_pago', 10)->nullable();
			$table->string('bandeira_cartao', 20)->nullable();
			$table->string('id_transacao', 45)->nullable();
			$table->integer('formas_pagamento_id_formas_pagamento')->index('fk_pagamento_pedido_formas_pagamento1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pagamento_pedido');
	}

}
