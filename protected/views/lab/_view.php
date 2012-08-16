<?php
/* @var $this LabController */
/* @var $model Lab */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lab')); ?>:</b>
	<?php echo CHtml::encode($data->lab); ?>
	<br />


</div>