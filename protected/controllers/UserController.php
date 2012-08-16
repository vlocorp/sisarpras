<?php

class UserController extends Controller {

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
            'postOnly + delete', // we only allow deletion via POST request
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
                'actions' => array('admin'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('delete', 'create', 'update', 'deleteSchedule'),
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
        $criteria->with = array('users' => array(
                'on' => 'users.id=' . $id,
                'together' => true,
                'joinType' => 'INNER JOIN',
                ));

        $scheduleDataProvider = new CActiveDataProvider('Schedule', array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 3,
                    ),
                ));

        //if there is post data then save and redirect to view page id
        if (isset($_POST['User'])) {
            $schedule_id = $_POST['User']['schedule_id'];
            $count = UserSchedule::model()->count("schedule_id = $schedule_id AND user_id = $id");
            if ($count > 0) {
                Yii::app()->user->setFlash('error', 'Schedule has already been set for this User');
                $this->redirect(array('view', 'id' => $id));
            } else {
                $userSchedule = new UserSchedule;
                $userSchedule->attributes = $_POST['User'];
                $userSchedule->user_id = $id;
                if ($userSchedule->save()) {
                    Yii::app()->user->setFlash('success', 'Schedule has been successfully added for this User');
                    $this->redirect(array('view', 'id' => $id));
                }
            }
        }

        $this->render('view', array(
            'model' => $this->loadModel($id),
            'scheduleDataProvider' => $scheduleDataProvider,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDeleteSchedule($id, $user_id) {
        UserSchedule::model()->findByPk($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(array('view', 'id' => $user_id));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->create_time = new CDbExpression('now()');
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

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->update_time = new CDbExpression('now()');
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
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

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
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function getGroupOptions() {
        $groupsArray = CHtml::listData(Group::model()->findAll(), 'id', 'group');
        return $groupsArray;
    }

    public function getScheduleOptions() {
        $schedulesArray = CHtml::listData(Schedule::model()->findAll(), 'id', 'course');
        return $schedulesArray;
    }



}
