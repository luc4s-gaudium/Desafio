<?php

/**
 * This is the model class for table "passageiro".
 *
 * The followings are the available columns in table 'passageiro':
 * @property integer $id
 * @property string $nome
 * @property string $nascimento
 * @property string $email
 * @property string $telefone
 * @property string $data_hora_status
 * @property string $status
 * @property string $obs
 */
class Passageiro extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'passageiro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('nome, nascimento, email, telefone, status', 'required'),
			array('email', 'email', 'message' => 'O formato do e-mail é inválido'),
			array('status', 'in', 'range' => array('A', 'I'), 'message' => 'O status deve ser "A" para Ativo ou "I" para Inativo'),
			array('telefone', 'match', 'pattern' => '/^\+\d{2}-\d{2}-\d{8,9}$/', 'message' => 'O formato do telefone deve ser +99-99-999999999'),

			array('nome', 'validarNomeCompleto'),

			array('nome, email, telefone', 'length', 'max' => 255),
			array('obs', 'length', 'max' => 200),

			array('id, nome, nascimento, email, telefone, data_hora_status, status, obs', 'safe', 'on' => 'search'),
			// array('nome, email, telefone', 'length', 'max' => 255),
			// array('status', 'length', 'max' => 1),
			// array('obs', 'length', 'max' => 200),
			// array('id, nome, nascimento, email, telefone, data_hora_status, status, obs', 'safe', 'on' => 'search'),
		);
	}

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
	 * @return array relational rules.
	 */
	public function relations()
	{
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
			'data_hora_status' => 'Data Hora Status',
			'status' => 'Status',
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

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('nome', $this->nome, true);
		$criteria->compare('nascimento', $this->nascimento, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('telefone', $this->telefone, true);
		$criteria->compare('data_hora_status', $this->data_hora_status, true);
		$criteria->compare('status', $this->status, true);
		$criteria->compare('obs', $this->obs, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Passageiro the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}
