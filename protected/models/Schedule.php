<?php

/**
 * This is the model class for table "schedule".
 *
 * The followings are the available columns in table 'schedule':
 * @property integer $id
 * @property string $course
 * @property string $start_time
 * @property string $end_time
 * @property integer $day
 * @property string $information
 * @property integer $lab_id
 *
 * The followings are the available model relations:
 * @property Absent[] $absents
 * @property Lab $lab
 * @property UserSchedule[] $userSchedules
 */
class Schedule extends CActiveRecord {

    public $user_id;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Schedule the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'schedule';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('day, lab_id', 'numerical', 'integerOnly' => true),
            array('course', 'length', 'max' => 256),
            array('course, start_time, end_time, day, lab', 'required'),
            array('start_time, end_time, information', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, course, start_time, end_time, day, information, lab_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'absents' => array(self::HAS_MANY, 'Absent', 'schedule_id'),
            'lab' => array(self::BELONGS_TO, 'Lab', 'lab_id'),
            //'userSchedules' => array(self::HAS_MANY, 'UserSchedule', 'schedule_id'),
            'users' => array(self::MANY_MANY, 'User', 'user_schedule(schedule_id, user_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'course' => 'Course',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'day' => 'Day',
            'information' => 'Information',
            'lab_id' => 'Lab',
            'user_id' => 'Add User to This Schedule',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('course', $this->course, true);
        $criteria->compare('start_time', $this->start_time, true);
        $criteria->compare('end_time', $this->end_time, true);
        $criteria->compare('day', $this->day);
        $criteria->compare('information', $this->information, true);
        $criteria->compare('lab_id', $this->lab_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function searchMySchedule() {
        date_default_timezone_set("Asia/Jakarta");   
        $start_time = date('H:i:s');
        $end_time = date("H:i:s", mktime(date("H")+3, date("i"), date("s")));
        $today = date('N');
        
        $criteria = new CDbCriteria();
        $criteria->with = array('users' => array(
                'on' => 'users.id=' . Yii::app()->user->id,
                'together' => true,
                'joinType' => 'INNER JOIN',
                ));
        $criteria->compare('schedule.id', $this->id);
        $criteria->compare('schedule.course', $this->course, true);
        $criteria->compare('start_time', $this->start_time, true);
        $criteria->compare('end_time', $this->end_time, true);
        $criteria->compare('day', $today);
        $criteria->compare('information', $this->information, true);
        $criteria->compare('lab_id', $this->lab_id);

//        $criteria->condition = ('start_time >= :start_time AND end_time <= :end_time');
//        $criteria->params = array(
//            ':start_time' => $start_time,
//            ':end_time' => $end_time,
//        );        

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}