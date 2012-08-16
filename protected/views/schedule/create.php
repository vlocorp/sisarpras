<?php
/* @var $this ScheduleController */
/* @var $model Schedule */

$this->breadcrumbs=array(
	'Schedules'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Schedule', 'url'=>array('index')),
	array('label'=>'Manage Schedule', 'url'=>array('admin')),
);
?>

<h1>Create Schedule</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>