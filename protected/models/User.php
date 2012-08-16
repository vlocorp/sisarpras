<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $create_time
 * @property string $update_time
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property integer $group_id
 *
 * The followings are the available model relations:
 * @property Absent[] $absents
 * @property Group $group
 * @property UserSchedule[] $userSchedules
 */
class User extends CActiveRecord {

    public $password_repeat;
    public $schedule_id;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('group_id', 'numerical', 'integerOnly' => true),
            array('username, name, phone, email', 'length', 'max' => 128),
            array('username, password, email', 'required'),
            array('username, email', 'unique', 'className' => 'User', 'attributeName' => 'email'),
            array('password', 'compare'),
            array('password_repeat', 'safe'),
            array('password', 'length', 'max' => 256),
            array('create_time, update_time, address', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, password, create_time, update_time, name, address, phone, email, group_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'absents' => array(self::HAS_MANY, 'Absent', 'user_id'),
            'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
            //'userSchedules' => array(self::HAS_MANY, 'UserSchedule', 'user_id'),
            'schedules' => array(self::MANY_MANY, 'Schedule', 'user_schedule(user_id, schedule_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
            'group_id' => 'Group',
            'schedule_id'=>'Add Schedule for this User',
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
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('group_id', $this->group_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * perform one-way encryption on the password before we store it in
      the database
     */
    protected function afterValidate() {
        parent::afterValidate(); //setelah proses validasi
        $this->password = $this->encrypt($this->password); //lakukan enkripsi password
    }

    public function encrypt($value) {
        return md5($value); //md5 enkripsi standard
    }

}