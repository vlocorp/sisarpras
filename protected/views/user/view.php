<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>View User #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'create_time',
		'update_time',
		'name',
		'address',
		'phone',
		'email',
		'group_id',
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
    'dataProvider'=>$scheduleDataProvider,
    'viewData'=>array('model'=>$model),
    'itemView'=>'_viewUserSchedule',        
));?>