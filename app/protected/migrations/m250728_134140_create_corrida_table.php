<?php

class m250728_134140_create_corrida_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('corrida', array(
			'id' => 'pk',
			'passageiro_id' => 'int',
			'motorista_id' => 'int',

			'endereco_origem' => 'string NOT NULL',
			'origem_lat' => 'decimal(10, 8) NOT NULL',
			'origem_lng' => 'decimal(11, 8) NOT NULL',

			'endereco_destino' => 'string NOT NULL',
			'destino_lat' => 'decimal(10, 8) NOT NULL',
			'destino_lng' => 'decimal(11, 8) NOT NULL',

			'data_hora_inicio' => 'datetime NOT NULL',
			'data_hora_finalizacao' => 'datetime NULL',
			'previsao_chegada_destino' => 'datetime NOT NULL',
			'tarifa' => 'decimal(10, 2) NOT NULL',

			'status' => "varchar(20) NOT NULL DEFAULT 'Em andamento'",
		));
		// Adiciona o relacionamento com a tabela de passageiros
		$this->addForeignKey(
			'fk-corrida-passageiro_id',
			'corrida',
			'passageiro_id',
			'passageiro',
			'id',
			'SET NULL',
			'CASCADE'
		);

		// Adiciona o relacionamento com a tabela de motoristas
		$this->addForeignKey(
			'fk-corrida-motorista_id',
			'corrida',
			'motorista_id',
			'motorista',
			'id',
			'SET NULL',
			'CASCADE'
		);
	}

	public function down()
	{
		$this->dropForeignKey('fk-corrida-passageiro_id', 'corrida');
		$this->dropForeignKey('fk-corrida-motorista_id', 'corrida');
		$this->dropTable('corrida');
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
