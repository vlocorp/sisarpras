<?php
/* @var $this ScheduleController */
/* @var $model Schedule */

$this->breadcrumbs=array(
	'Schedules'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Schedule', 'url'=>array('index')),
	array('label'=>'Create Schedule', 'url'=>array('create')),
	array('label'=>'Update Schedule', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Schedule', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Schedule', 'url'=>array('admin')),
);
?>

<h1>View Schedule #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'course',
		'start_time',
		'end_time',
		'day',
		'information',
		'lab_id',
	),
)); ?>

<!-- FLASH MESSAGE -->
<?php foreach(Yii::app()->user->getFlashes() as $key => $message):?>
<div class="flash-<?php echo $key;?>">
    <?php echo $message;?>
</div>
<?php endforeach;?>

<!-- FORM USER -->
<?php $this->renderPartial('_formUserSchedule', array(
    'model'=>$model,
));?>

<!-- VIEW USERS -->
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$userDataProvider,
    'viewData'=>array('model'=>$model),
    'itemView'=>'_viewUserSchedule',        
));?>

