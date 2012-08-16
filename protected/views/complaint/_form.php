<?php
/* @var $this ComplaintController */
/* @var $model Complaint */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'complaint-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'complaint'); ?>
		<?php
                $this->widget('ext.editMe.ExtEditMe', array(
                    'model'=>$model,
                    'attribute'=>'complaint',               
                ));
                ?>
		<?php echo $form->error($model,'complaint'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->