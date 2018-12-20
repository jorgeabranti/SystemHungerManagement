<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPagamentosPedidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pagamentos_pedidos', function(Blueprint $table)
		{
			$table->foreign('formas_pagamento_empresa_id_forma_pagamento_empresa', 'fk_pagamento_pedido_formas_pagamento_empresa1')->references('id_forma_pagamento_empresa')->on('formas_pagamento_empresa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pagamentos_pedidos', function(Blueprint $table)
		{
			$table->dropForeign('fk_pagamento_pedido_formas_pagamento_empresa1');
		});
	}

}
