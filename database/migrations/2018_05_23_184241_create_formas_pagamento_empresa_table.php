<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormasPagamentoEmpresaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('formas_pagamento_empresa', function(Blueprint $table)
		{
			$table->integer('id_forma_pagamento_empresa', true);
			$table->integer('empresas_id_empresa')->index('fk_formas_pagamento_empresas1_idx');
			$table->boolean('status_forma_pagamento_empresa');
			$table->integer('formas_pagamento_id_forma_pagamento')->index('fk_formas_pagamento_empresa_formas_pagamento1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('formas_pagamento_empresa');
	}

}
