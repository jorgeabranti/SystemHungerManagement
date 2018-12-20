<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFormasPagamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('formas_pagamento', function(Blueprint $table)
		{
			$table->foreign('empresas_id_empresa', 'fk_formas_pagamento_empresas1')->references('id_empresa')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('formas_pagamento', function(Blueprint $table)
		{
			$table->dropForeign('fk_formas_pagamento_empresas1');
		});
	}

}
