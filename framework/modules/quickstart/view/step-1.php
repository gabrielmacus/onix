
<?php $this->layout("steps",["title"=>$lang->i18n("initialConfigData"),"stepNumber"=>1] + $this->data);  ?>


<?php $this->start('step-body') ?>

<?php

$c = new \framework\modules\configuration\model\Configuration();

$cModel = $c->model();

$elementsArray=[];


$elementsArray[]= new \framework\modules\gui\input\model\InputComponent("app_name",$lang);

$elementsArray[]= new \framework\modules\gui\input\model\InputComponent("app_url",$lang);

$elementsArray[]= new \framework\modules\gui\input\model\InputComponent("site_name",$lang);

$elementsArray[]= new \framework\modules\gui\input\model\InputComponent("site_url",$lang);

$elementsArray[]= new \framework\modules\gui\input\model\InputComponent("db_name",$lang);

$elementsArray[]= new \framework\modules\gui\input\model\InputComponent("db_user",$lang);

$elementsArray[]= new \framework\modules\gui\input\model\InputComponent("db_pass",$lang,"password");

$elementsArray[]= new \framework\modules\gui\input\model\InputComponent("db_host",$lang);

$elementsArray[]= new \framework\modules\gui\input\model\InputComponent("db_port",$lang,"number",["min"=>1,"max"=>65535]);

$form = new \framework\modules\gui\form\model\FormComponent($elementsArray,"post",$lang);
?>

<?= $form ?>


<?php  $this->stop()?>

