<!-- FLASH MESSAGE -->
<?php foreach(Yii::app()->user->getFlashes() as $key => $message):?>
<div class="flash-<?php echo $key;?>">
    <?php echo $message;?>
</div>
<?php endforeach;?>