<?php
/* @var $this AbsentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Absents',
);

$this->menu=array(	
	array('label'=>'Manage Absent', 'url'=>array('admin')),
);
?>

<h1>Absents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
