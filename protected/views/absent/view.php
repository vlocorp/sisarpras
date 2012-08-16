<?php
/* @var $this AbsentController */
/* @var $model Absent */

$this->breadcrumbs=array(
	'Absents'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Absent', 'url'=>array('index')),
	array('label'=>'Create Absent', 'url'=>array('create')),
	array('label'=>'Update Absent', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Absent', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Absent', 'url'=>array('admin')),
);
?>

<h1>View Absent #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'start_time',
		'end_time',
		'schedule_id',
		'date',
	),
)); ?>
