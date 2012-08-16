<?php
/* @var $this AbsentController */
/* @var $model Absent */

$this->breadcrumbs = array(
    'Absents' => array('index'),
    'Manage',
);

$this->menu = array(
        //array('label'=>'List Absent', 'url'=>array('index')),	
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('absent-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link('Create User', array('/user/create'), array('id'=>'add_button'));?>

<h1>Manage Absents</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'absent-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'afterAjaxUpdate' => 'reinstallDatePicker', // (#1)
    'columns' => array(
        'id',
        array(
            'header' => 'User',
            'name' => 'user_id',
            'value' => '$data->user->username',
            'filter' => CHtml::listData(User::model()->findAll(), 'id', 'username'),
        ),
        array(
            'header' => 'Check In',
            'name' => 'start_time',
        ),
        array(
            'header' => 'Check Out',
            'name' => 'end_time',
        ),
        array(
            'header' => 'Schedule',
            'name' => 'schedule_id',
            'value' => '$data->schedule->course',
            'filter' => CHtml::listData(Schedule::model()->findAll(), 'id', 'course'),
        ),
        array(
            'name' => 'date',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(                
                'model' => $model,
                'attribute' => 'date',
                'language' => 'ja',
                'options' => array(
                    'showAnim' => 'fold',
                ),
                'htmlOptions' => array(
                    'style' => 'height:20px;'
                ),
                'i18nScriptFile' => 'jquery.ui.datepicker-ja.js', // (#2)
                'htmlOptions' => array(
                    'id' => 'datepicker_for_due_date',
                    'size' => '10',
                ),
                'defaultOptions' => array(// (#3)
                    'showOn' => 'focus',
                    'dateFormat' => 'yy-mm-dd',
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showButtonPanel' => true,
                ),
                    ), true),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{delete}',
        ),
    ),
));
?>

<?php
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_due_date').datepicker();
}
");
?>