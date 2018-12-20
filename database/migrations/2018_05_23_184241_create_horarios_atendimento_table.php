<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHorariosAtendimentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('horarios_atendimento', function(Blueprint $table)
		{
			$table->integer('id_horario_atendimento', true);
			$table->integer('empresas_id_empresa')->index('fk_horarios_atendimento_empresas1_idx');
			$table->boolean('atendimento_segunda')->nullable()->default(0);
			$table->boolean('atendimento_terca')->nullable()->default(0);
			$table->boolean('atendimento_quarta')->nullable()->default(0);
			$table->boolean('atendimento_quinta')->nullable()->default(0);
			$table->boolean('atendimento_sexta')->nullable()->default(0);
			$table->boolean('atendimento_sabado')->nullable()->default(0);
			$table->boolean('atendimento_domingo')->nullable()->default(0);
			$table->time('horario_inicio_segunda')->nullable();
			$table->time('horario_fim_segunda')->nullable();
			$table->time('horario_inicio_terca')->nullable();
			$table->time('horario_fim_terca')->nullable();
			$table->time('horario_inicio_quarta')->nullable();
			$table->time('horario_fim_quarta')->nullable();
			$table->time('horario_inicio_quinta')->nullable();
			$table->time('horario_fim_quinta')->nullable();
			$table->time('horario_inicio_sexta')->nullable();
			$table->time('horario_fim_sexta')->nullable();
			$table->time('horario_inicio_sabado')->nullable();
			$table->time('horario_fim_sabado')->nullable();
			$table->time('horario_inicio_domingo')->nullable();
			$table->time('horario_fim_domingo')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('horarios_atendimento');
	}

}
