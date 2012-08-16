<?php
/* @var $this ScheduleController */
/* @var $model Schedule */

$this->breadcrumbs=array(
	'Schedules'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Schedule', 'url'=>array('index')),
	array('label'=>'Create Schedule', 'url'=>array('create')),
	array('label'=>'View Schedule', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Schedule', 'url'=>array('admin')),
);
?>

<h1>Update Schedule <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>