<?php
/* @var $this UserScheduleController */
/* @var $model UserSchedule */
?>

<div class="view">
        
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('/user/view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />
        
        <?php $userScheduleId = UserSchedule::model()->findByAttributes(array('user_id'=>$data->id, 'schedule_id'=>$model->id))->id;?>
        <b><?php echo CHtml::link('Delete User From Schedule', array('deleteUser', 'id'=> $userScheduleId, 'schedule_id'=>$model->id), array('confirm'=>'Are you sure delete this user from schedule?'));?></b>
        <br />


</div>