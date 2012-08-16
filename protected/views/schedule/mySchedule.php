<h3>Your Schedule Today</h3>

<?php
$this->widget('ext.vlo.flash.VFlash');

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'schedule-grid',
    'dataProvider' => $model->searchMySchedule(),
    'filter' => $model,
    'columns' => array(
        'id',
        'course',
        'start_time',
        'end_time',        
        'information',
        /*
          'lab_id',
         */
        array(
            'class' => 'CButtonColumn',
            'template' => '{checkin} {checkout}',
            'header' => 'Absent',
            'buttons' => array(
                'checkin' => array(
                    'label' => 'Check In',
                    'url' => 'Yii::app()->createUrl("schedule/checkIn",array("schedule_id"=>$data->id))',
                ),
                'checkout' => array(
                    'label' => 'Check Out',
                    'url' => 'Yii::app()->createUrl("schedule/checkOut",array("schedule_id"=>$data->id))',
                ),
            ),
        ),
    ),
));
?>
