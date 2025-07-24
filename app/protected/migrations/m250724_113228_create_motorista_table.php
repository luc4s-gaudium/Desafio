<?php

class m250724_113228_create_motorista_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('motorista', array(
			'id' => 'pk',
			'nome' => 'string NOT NULL',
			'nascimento' => 'date NOT NULL',
			'email' => 'string NOT NULL UNIQUE',
			'telefone' => 'string NOT NULL',
			'placa_veiculo' => 'varchar(8) NOT NULL',
			'status' => 'char(1) NOT NULL DEFAULT "A"',
			'data_hora_status' => 'datetime NOT NULL',
			'obs' => 'varchar(200)'
		));
	}

	public function down()
	{
		$this->dropTable('motorista');
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
