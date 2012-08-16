<?php

class TestingController extends Controller {

    public function actionIndex() {  
        date_default_timezone_set("Asia/Jakarta");
        $date = date('Y-m-d');
        $schedule_id = 3;
        
        $countAbsent = $model = Absent::model()->count('date=:date AND schedule_id = :schedule_id AND end_time IS NULL', array(
            ':date' => $date,
            ':schedule_id' => $schedule_id,
                ));
        echo $countAbsent;
    }

}
