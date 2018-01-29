
<?php $this->layout("steps",["title"=>$lang->i18n("initialConfigData"),"stepNumber"=>1] + $this->data);  ?>


<?php $this->start('step-body') ?>


<?= new \framework\modules\gui\input\model\InputComponent("demo","text",$lang)?>

<?= new \framework\modules\gui\input\model\InputComponent("demo","text",$lang)?>

<?php  $this->stop()?>

