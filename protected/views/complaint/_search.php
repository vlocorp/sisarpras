<?php
/* @var $this ComplaintController */
/* @var $model Complaint */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ip_address'); ?>
		<?php echo $form->textField($model,'ip_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'complaint'); ?>
		<?php echo $form->textArea($model,'complaint',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->