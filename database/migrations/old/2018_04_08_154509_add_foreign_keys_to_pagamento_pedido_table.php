<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPagamentoPedidoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pagamento_pedido', function(Blueprint $table)
		{
			$table->foreign('formas_pagamento_id_formas_pagamento', 'fk_pagamento_pedido_formas_pagamento1')->references('id_formas_pagamento')->on('formas_pagamento')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pagamento_pedido', function(Blueprint $table)
		{
			$table->dropForeign('fk_pagamento_pedido_formas_pagamento1');
		});
	}

}
