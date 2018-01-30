
<?php $this->layout("steps",["title"=>$lang->i18n("initialConfigData"),"stepNumber"=>1] + $this->data);  ?>


<?php $this->start('step-body') ?>

<form method="post" action="quickstart">
    <?= $this->fetch('components::input',["name"=>"app_name","label"=>$lang->i18n("app_name")]);?>

    <?= $this->fetch('components::input',["name"=>"app_url","label"=>$lang->i18n("app_url")]);?>

    <?= $this->fetch('components::input',["name"=>"site_name","label"=>$lang->i18n("site_name")]);?>

    <?= $this->fetch('components::input',["name"=>"site_url","label"=>$lang->i18n("site_url")]);?>

    <?= $this->fetch('components::input',["name"=>"db_name","label"=>$lang->i18n("db_name")]);?>

    <?= $this->fetch('components::input',["name"=>"db_pass","label"=>$lang->i18n("db_pass")]);?>

    <?= $this->fetch('components::input',["name"=>"db_host","label"=>$lang->i18n("db_host")]);?>

    <?= $this->fetch('components::input',["type"=>"number","name"=>"db_port","label"=>$lang->i18n("db_port")]);?>

    <?= $this->fetch('components::button',["type"=>"submit","label"=>$lang->i18n("sendForm")]);?>


</form>



<?php  $this->stop()?>
