<?php
/* @var $this ScheduleController */
/* @var $model Schedule */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'schedule-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'course'); ?>
		<?php echo $form->textField($model,'course',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'course'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_time'); ?>
		<?php 
                $this->widget('ext.timepicker.timepicker', array(
                    'model'=>$model,
                    'name'=>'start_time',
                ));
                ?>
		<?php echo $form->error($model,'start_time'); ?>
	</div>                

	<div class="row">
		<?php echo $form->labelEx($model,'end_time'); ?>
		<?php 
                $this->widget('ext.timepicker.timepicker', array(
                    'model'=>$model,
                    'name'=>'end_time',
                ));
                ?>
		<?php echo $form->error($model,'end_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'day'); ?>
		<?php echo $form->dropDownList($model, 'day', $this->getDayOptions());?>
		<?php echo $form->error($model,'day'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'information'); ?>
		<?php
                $this->widget('ext.editMe.ExtEditMe', array(
                    'model'=>$model,
                    'attribute'=>'information',               
                ));
                ?>
		<?php echo $form->error($model,'information'); ?>
	</div>
                

	<div class="row">
		<?php echo $form->labelEx($model,'lab_id'); ?>
		<?php echo $form->dropDownList($model,'lab_id',$this->getLabOptions()); ?>
		<?php echo $form->error($model,'lab_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->