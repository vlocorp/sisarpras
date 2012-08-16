<?php
/* @var $this UserScheduleController */
/* @var $model UserSchedule */

$this->breadcrumbs=array(
	'User Schedules'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserSchedule', 'url'=>array('index')),
	array('label'=>'Create UserSchedule', 'url'=>array('create')),
	array('label'=>'View UserSchedule', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserSchedule', 'url'=>array('admin')),
);
?>

<h1>Update UserSchedule <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>