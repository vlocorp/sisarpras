<?php
/* @var $this AbsentController */
/* @var $model Absent */

$this->breadcrumbs=array(
	'Absents'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Absent', 'url'=>array('index')),
	array('label'=>'Manage Absent', 'url'=>array('admin')),
);
?>

<h1>Create Absent</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>