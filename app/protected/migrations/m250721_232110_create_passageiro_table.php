<?php

class m250721_232110_create_passageiro_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('passageiro', array(
			'id' => 'pk',
			'nome' => 'string NOT NULL',
			'nascimento' => 'date NOT NULL',
			'email' => 'string NOT NULL UNIQUE',
			'telefone' => 'string NOT NULL',
			'data_hora_status' => 'datetime NOT NULL',
			'status' => "char(1) NOT NULL DEFAULT 'A'",
			'obs' => 'varchar(200)'
		));
	}

	public function down()
	{
		$this->dropTable('passageiro');
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
