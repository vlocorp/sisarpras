<?php
/* @var $this UserScheduleController */
/* @var $model UserSchedule */
?>

<div class="view">
        
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('/schedule/view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('schedule_id')); ?>:</b>
	<?php echo CHtml::encode($data->course); ?>
	<br />
        
        <?php $userScheduleId = UserSchedule::model()->findByAttributes(array('schedule_id'=>$data->id, 'user_id'=>$model->id))->id;?>
        <b><?php echo CHtml::link('Delete Schedule From User', array('deleteSchedule', 'id'=> $userScheduleId, 'user_id'=>$model->id), array('confirm'=>'Are you sure delete this user from schedule?'));?></b>
        <br />


</div>