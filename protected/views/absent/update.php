<?php
/* @var $this AbsentController */
/* @var $model Absent */

$this->breadcrumbs=array(
	'Absents'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Absent', 'url'=>array('index')),
	array('label'=>'Create Absent', 'url'=>array('create')),
	array('label'=>'View Absent', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Absent', 'url'=>array('admin')),
);
?>

<h1>Update Absent <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>