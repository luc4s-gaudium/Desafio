<?php

/**
 * This is the model class for table "motorista".
 *
 * The followings are the available columns in table 'motorista':
 * @property integer $id
 * @property string $nome
 * @property string $nascimento
 * @property string $email
 * @property string $telefone
 * @property string $placa_veiculo
 * @property string $status
 * @property string $data_hora_status
 * @property string $obs
 */
class Motorista extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'motorista';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			// Campos obrigatórios
			array('nome, nascimento, email, telefone, placa_veiculo, status', 'required'),

			// Validações de formato (copiadas do Passageiro)
			array('email', 'email', 'message' => 'O formato do e-mail é inválido.'),
			array('status', 'in', 'range' => array('A', 'I'), 'message' => 'O status deve ser "A" ou "I".'),
			array('telefone', 'match', 'pattern' => '/^\+\d{2}-\d{2}-\d{8,9}$/', 'message' => 'O formato do telefone deve ser +99-99-999999999.'),

			// Validações customizadas
			array('nome', 'validarNomeCompleto'),
			array('placa_veiculo', 'validarPlacaVeiculo'),

			// Validações de tamanho
			array('nome, email, telefone', 'length', 'max' => 255),
			array('placa_veiculo', 'length', 'max' => 8),
			array('obs', 'length', 'max' => 200),

			// Regra para a busca
			array('id, nome, nascimento, email, telefone, placa_veiculo, status, data_hora_status, obs', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * Validador customizado para o nome completo (mesma regra do passageiro).
	 */
	public function validarNomeCompleto($attribute, $params)
	{
		if (!$this->hasErrors($attribute)) {
			$nomeCompleto = trim($this->$attribute);
			$partesNome = array_filter(explode(' ', $nomeCompleto));
			if (count($partesNome) < 2) {
				$this->addError($attribute, 'O nome completo deve ter no mínimo duas palavras.');
				return;
			}
			foreach ($partesNome as $palavra) {
				if (mb_strlen($palavra, 'UTF-8') < 3) {
					$this->addError($attribute, 'Cada palavra do nome deve ter no mínimo 3 caracteres.');
					return;
				}
			}
		}
	}

	/**
	 * Validador customizado para a placa do veículo (formato antigo ou Mercosul).
	 */
	public function validarPlacaVeiculo($attribute, $params)
	{
		if (!$this->hasErrors($attribute)) {
			$placa = $this->$attribute;
			// A Expressão Regular abaixo verifica os dois formatos:
			// ^[A-Z]{3}-\d{4}$  -> Formato AAA-9999
			// |                -> OU
			// ^[A-Z]{3}\d[A-Z]\d{2}$ -> Formato AAA9A99
			if (!preg_match('/^[A-Z]{3}-\d{4}$|^[A-Z]{3}\d[A-Z]\d{2}$/', $placa)) {
				$this->addError($attribute, 'A placa do veículo não está em um formato válido (AAA-9999 ou AAA9A99).');
			}
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nome' => 'Nome',
			'nascimento' => 'Nascimento',
			'email' => 'Email',
			'telefone' => 'Telefone',
			'placa_veiculo' => 'Placa Veiculo',
			'status' => 'Status',
			'data_hora_status' => 'Data Hora Status',
			'obs' => 'Obs',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('nome', $this->nome, true);
		$criteria->compare('nascimento', $this->nascimento, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('telefone', $this->telefone, true);
		$criteria->compare('placa_veiculo', $this->placa_veiculo, true);
		$criteria->compare('status', $this->status, true);
		$criteria->compare('data_hora_status', $this->data_hora_status, true);
		$criteria->compare('obs', $this->obs, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Motorista the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}
