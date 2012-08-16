<?php

/**
 * This is the model class for table "lab".
 *
 * The followings are the available columns in table 'lab':
 * @property integer $id
 * @property string $laboratorium
 *
 * The followings are the available model relations:
 * @property Schedule[] $schedules
 */
class Lab extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Lab the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lab';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lab', 'length', 'max'=>128),
			array('lab', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, lab', 'safe', 'on'=>'search'),
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
			'schedules' => array(self::HAS_MANY, 'Schedule', 'lab_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'lab' => 'Laboratory',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('lab',$this->lab,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}