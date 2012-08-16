<?php

/**
 * This is the model class for table "absent".
 *
 * The followings are the available columns in table 'absent':
 * @property integer $id
 * @property integer $user_id
 * @property string $start_time
 * @property string $end_time
 * @property integer $schedule_id
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Schedule $schedule
 * @property User $user
 */
class Absent extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Absent the static model class
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
		return 'absent';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, schedule_id', 'numerical', 'integerOnly'=>true),
			array('start_time, end_time, date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, start_time, end_time, schedule_id, date', 'safe', 'on'=>'search'),
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
			'schedule' => array(self::BELONGS_TO, 'Schedule', 'schedule_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'schedule_id' => 'Schedule',
			'date' => 'Date',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('schedule_id',$this->schedule_id);
		$criteria->compare('date',$this->date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}