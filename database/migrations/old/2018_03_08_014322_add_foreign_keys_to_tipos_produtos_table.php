<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTiposProdutosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tipos_produtos', function(Blueprint $table)
		{
			$table->foreign('empresas_id_empresa', 'fk_tipos_produtos_empresas1')->references('id_empresa')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tipos_produtos', function(Blueprint $table)
		{
			$table->dropForeign('fk_tipos_produtos_empresas1');
		});
	}

}
