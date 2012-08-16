<?php
/* @var $this UserScheduleController */
/* @var $model UserSchedule */

$this->breadcrumbs=array(
	'User Schedules'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserSchedule', 'url'=>array('index')),
	array('label'=>'Create UserSchedule', 'url'=>array('create')),
	array('label'=>'Update UserSchedule', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserSchedule', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserSchedule', 'url'=>array('admin')),
);
?>

<h1>View UserSchedule #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'schedule_id',
	),
)); ?>
