<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormasPagamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('formas_pagamento', function(Blueprint $table)
		{
			$table->integer('id_formas_pagamento', true);
			$table->string('nome_forma_pagamento', 40)->nullable();
			$table->integer('empresas_id_empresa')->index('fk_formas_pagamento_empresas1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('formas_pagamento');
	}

}
