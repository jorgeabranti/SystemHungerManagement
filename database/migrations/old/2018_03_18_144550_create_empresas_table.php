<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmpresasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresas', function(Blueprint $table)
		{
			$table->integer('id_empresa', true);
			$table->string('razao_social', 100)->nullable();
			$table->string('nome_fantasia', 100)->nullable();
			$table->string('cnpj_empresa', 18)->nullable();
			$table->timestamp('data_cadastro')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('id_page_empresa', 45)->nullable();
			$table->decimal('taxa_km_entrega', 10)->nullable();
			$table->boolean('status_empresa')->nullable()->default(1);
			$table->time('horario_atendimento_inicio')->nullable();
			$table->time('horario_atendimento_fim')->nullable();
			$table->boolean('atendimento_segunda')->nullable()->default(0);
			$table->boolean('atendimento_terca')->nullable()->default(0);
			$table->boolean('atendimento_quarta')->nullable()->default(0);
			$table->boolean('atendimento_quinta')->nullable()->default(0);
			$table->boolean('atendimento_sexta')->nullable()->default(0);
			$table->boolean('atendimento_sabado')->nullable()->default(0);
			$table->boolean('atendimento_domingo')->nullable()->default(0);
			$table->bigInteger('telefone1_empresa')->nullable();
			$table->bigInteger('telefone2_empresa')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('empresas');
	}

}
