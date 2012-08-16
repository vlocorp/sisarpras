<?php
/* @var $this UserScheduleController */
/* @var $model UserSchedule */

$this->breadcrumbs=array(
	'User Schedules'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserSchedule', 'url'=>array('index')),
	array('label'=>'Manage UserSchedule', 'url'=>array('admin')),
);
?>

<h1>Create UserSchedule</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>