<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSaboresProdutosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sabores_produtos', function(Blueprint $table)
		{
			$table->foreign('tipos_produtos_id_tipo_produto', 'fk_sabores_produtos_tipos_produtos1')->references('id_tipo_produto')->on('tipos_produtos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sabores_produtos', function(Blueprint $table)
		{
			$table->dropForeign('fk_sabores_produtos_tipos_produtos1');
		});
	}

}
