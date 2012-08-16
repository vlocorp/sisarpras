<?php
/* @var $this UserScheduleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Schedules',
);

$this->menu=array(
	array('label'=>'Create UserSchedule', 'url'=>array('create')),
	array('label'=>'Manage UserSchedule', 'url'=>array('admin')),
);
?>

<h1>User Schedules</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
