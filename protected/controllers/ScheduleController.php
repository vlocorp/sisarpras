<?php

Yii::import('ext.vlo.date.VDate');

class ScheduleController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
                //'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('admin', 'mySchedule', 'checkIn', 'checkOut'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('delete', 'create', 'update', 'deleteUser'),
                'users' => $this->getUsersByGroup(1),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * to generate group of users     
     */
    private function getUsersByGroup($group_id) {
        $models = User::model()->findAllByAttributes(array(
            'group_id' => $group_id,
                ));
        $data = array();
        $i = 0;
        foreach ($models as $model) {
            $data[$i] = $model->username;
            $i++;
        }
        return $data;
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $criteria = new CDbCriteria;
        $criteria->with = array('schedules' => array(
                'on' => 'schedules.id=' . $id,
                'together' => true,
                'joinType' => 'INNER JOIN',
                ));

        $userDataProvider = new CActiveDataProvider('User', array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 3,
                    ),
                ));

        //if there is post data then save and redirect to view page id
        if (isset($_POST['Schedule'])) {
            $user_id = $_POST['Schedule']['user_id'];
            $count = UserSchedule::model()->count("user_id = $user_id AND schedule_id = $id");
            if ($count > 0) {
                Yii::app()->user->setFlash('error', 'User has already there in this schedule');
                $this->redirect(array('view', 'id' => $id));
            } else {
                $userSchedule = new UserSchedule;
                $userSchedule->attributes = $_POST['Schedule'];
                $userSchedule->schedule_id = $id;
                if ($userSchedule->save()) {
                    Yii::app()->user->setFlash('success', 'User has been successfully saved in this schedule');
                    $this->redirect(array('view', 'id' => $id));
                }
            }
        }

        $this->render('view', array(
            'model' => $this->loadModel($id),
            'userDataProvider' => $userDataProvider,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDeleteUser($id, $schedule_id) {
        UserSchedule::model()->findByPk($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(array('view', 'id' => $schedule_id));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Schedule;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Schedule'])) {
            $model->attributes = $_POST['Schedule'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Schedule'])) {
            $model->attributes = $_POST['Schedule'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Schedule');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Schedule('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Schedule']))
            $model->attributes = $_GET['Schedule'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Schedule::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'schedule-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * get date for _form         
     */
    protected function getDayOptions() {
        $date = new VDate();
        return $date->getDayOptions();
    }

    /**
     * get text for date         
     */
    protected function getDayText($day) {
        $date = new VDate();
        return $date->getDay($day);
    }

    /**
     * get lab for _form dropdown 
     */
    protected function getLabOptions() {
        $labsArray = CHtml::listData(Lab::model()->findAll(), 'id', 'lab');
        return $labsArray;
    }

    /**
     * get user options for _form dropdown     
     */
    public function getUserOptions() {
        $usersArray = CHtml::listData(User::model()->findAll(), 'id', 'username');
        return $usersArray;
    }

    /**
     * looking for my schedule 
     */
    public function actionMySchedule() {
        $model = new Schedule('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Schedule']))
            $model->attributes = $_GET['Schedule'];

        $this->render('mySchedule', array(
            'model' => $model,
        ));
    }

    /**
     * for menu absent check in, set start time by time now()     
     */
    public function actionCheckIn($schedule_id) {
        date_default_timezone_set("Asia/Jakarta");
        $date = date('Y-m-d');
        $start_time = date('H:i:s');

        $countAbsent = $model = Absent::model()->count('date=:date AND schedule_id = :schedule_id', array(
            ':date' => $date,
            ':schedule_id' => $schedule_id,
                ));

        if ($countAbsent > 0) {
            Yii::app()->user->setFlash('error', 'you are already absent in this course today');
            $this->redirect('mySchedule');
        } else {
            $model = new Absent();
            $model->user_id = Yii::app()->user->id;
            $model->date = date('Y-m-d');
            $model->schedule_id = $schedule_id;
            $model->start_time = $start_time;
            $model->save();

            Yii::app()->user->setFlash('success', 'thank you for absent in ' . $model->schedule->course . ' course today');
            $this->redirect('mySchedule');
        }
    }

    /**
     * for menu absent check out, set endtime by time now()     
     */
    public function actionCheckOut($schedule_id) {
        date_default_timezone_set("Asia/Jakarta");
        $date = date('Y-m-d');
        $end_time = date('H:i:s');

        $countAbsent = $model = Absent::model()->count('date=:date AND schedule_id = :schedule_id AND end_time IS NULL', array(
            ':date' => $date,
            ':schedule_id' => $schedule_id,
                ));

        if ($countAbsent > 0) {
            $model = Absent::model()->findByAttributes(array(
                'date' => $date,
                'schedule_id' => $schedule_id,
                    ));
            $model->end_time = $end_time;
            $model->update();
            Yii::app()->user->setFlash('success', 'thank you for absent today');
            $this->redirect('mySchedule');
        } else {
            Yii::app()->user->setFlash('error', 'you are already check out for this course');
            $this->redirect('mySchedule');
        }
    }

}
