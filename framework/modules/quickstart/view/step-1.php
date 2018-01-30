
<?php $this->layout("steps",["title"=>$lang->i18n("initialConfigData"),"stepNumber"=>1] + $this->data);  ?>


<?php $this->start('step-body') ?>
<?php $formElements = [new \framework\modules\gui\input\model\InputComponent("A",$lang)]; ?>
<?php $form = new \framework\modules\gui\form\model\FormComponent($formElements,"",$lang) ?>
<?= $form ?>

<?php  $this->stop()?>

