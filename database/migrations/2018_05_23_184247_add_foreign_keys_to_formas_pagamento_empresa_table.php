<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFormasPagamentoEmpresaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('formas_pagamento_empresa', function(Blueprint $table)
		{
			$table->foreign('formas_pagamento_id_forma_pagamento', 'fk_formas_pagamento_empresa_formas_pagamento1')->references('id_forma_pagamento')->on('formas_pagamento')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
		Schema::table('formas_pagamento_empresa', function(Blueprint $table)
		{
			$table->dropForeign('fk_formas_pagamento_empresa_formas_pagamento1');
			$table->dropForeign('fk_formas_pagamento_empresas1');
		});
	}

}
