<?php

/**
 * This is the model class for table "corrida".
 *
 * The followings are the available columns in table 'corrida':
 * @property integer $id
 * @property integer $passageiro_id
 * @property integer $motorista_id
 * @property string $endereco_origem
 * @property string $origem_lat
 * @property string $origem_lng
 * @property string $endereco_destino
 * @property string $destino_lat
 * @property string $destino_lng
 * @property string $data_hora_inicio
 * @property string $data_hora_finalizacao
 * @property string $previsao_chegada_destino
 * @property string $tarifa
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Motorista $motorista
 * @property Passageiro $passageiro
 */
class Corrida extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'corrida';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('endereco_origem, origem_lat, origem_lng, endereco_destino, destino_lat, destino_lng, data_hora_inicio, previsao_chegada_destino, tarifa', 'required'),
			array('passageiro_id, motorista_id', 'numerical', 'integerOnly'=>true),
			array('endereco_origem, endereco_destino', 'length', 'max'=>255),
			array('origem_lat, destino_lat, tarifa', 'length', 'max'=>10),
			array('origem_lng, destino_lng', 'length', 'max'=>11),
			array('status', 'length', 'max'=>20),
			array('data_hora_finalizacao', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, passageiro_id, motorista_id, endereco_origem, origem_lat, origem_lng, endereco_destino, destino_lat, destino_lng, data_hora_inicio, data_hora_finalizacao, previsao_chegada_destino, tarifa, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'motorista' => array(self::BELONGS_TO, 'Motorista', 'motorista_id'),
			'passageiro' => array(self::BELONGS_TO, 'Passageiro', 'passageiro_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'passageiro_id' => 'Passageiro',
			'motorista_id' => 'Motorista',
			'endereco_origem' => 'Endereco Origem',
			'origem_lat' => 'Origem Lat',
			'origem_lng' => 'Origem Lng',
			'endereco_destino' => 'Endereco Destino',
			'destino_lat' => 'Destino Lat',
			'destino_lng' => 'Destino Lng',
			'data_hora_inicio' => 'Data Hora Inicio',
			'data_hora_finalizacao' => 'Data Hora Finalizacao',
			'previsao_chegada_destino' => 'Previsao Chegada Destino',
			'tarifa' => 'Tarifa',
			'status' => 'Status',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('passageiro_id',$this->passageiro_id);
		$criteria->compare('motorista_id',$this->motorista_id);
		$criteria->compare('endereco_origem',$this->endereco_origem,true);
		$criteria->compare('origem_lat',$this->origem_lat,true);
		$criteria->compare('origem_lng',$this->origem_lng,true);
		$criteria->compare('endereco_destino',$this->endereco_destino,true);
		$criteria->compare('destino_lat',$this->destino_lat,true);
		$criteria->compare('destino_lng',$this->destino_lng,true);
		$criteria->compare('data_hora_inicio',$this->data_hora_inicio,true);
		$criteria->compare('data_hora_finalizacao',$this->data_hora_finalizacao,true);
		$criteria->compare('previsao_chegada_destino',$this->previsao_chegada_destino,true);
		$criteria->compare('tarifa',$this->tarifa,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Corrida the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
