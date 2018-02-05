
<?php $this->layout("steps",["title"=>$lang->i18n("initialConfigData"),"stepNumber"=>1,"pageTitle"=>$lang->i18n("initialConfigData")." - ".$lang->i18n("stepNumber:1")] + $this->data);  ?>


<?php $this->start('step-body') ?>

<form id="step-1-form" method="post" enctype="application/x-www-form-urlencoded" action="<?= "/api/quickstart" ?>">


    <fieldset form="step-1-form">

        <legend><?= $lang->i18n("applicationData");?></legend>

        <?= $this->fetch('components::input',["name"=>"app_name","label"=>$lang->i18n("app_name")]);?>

    </fieldset>

    <fieldset form="step-1-form">

        <legend><?= $lang->i18n("siteData")?></legend>

        <?= $this->fetch('components::input',["name"=>"site_name","label"=>$lang->i18n("site_name")]);?>

        <?= $this->fetch('components::input',["name"=>"site_url","label"=>$lang->i18n("site_url")]);?>

    </fieldset>


    <fieldset form="step-1-form">
        <legend><?= $lang->i18n("dbData");?></legend>
        <?= $this->fetch('components::input',["name"=>"db_name","label"=>$lang->i18n("db_name")]);?>

        <?= $this->fetch('components::input',["name"=>"db_user","label"=>$lang->i18n("db_user")]);?>

        <?= $this->fetch('components::input',["name"=>"db_pass","label"=>$lang->i18n("db_pass")]);?>

        <?= $this->fetch('components::input',["name"=>"db_host","label"=>$lang->i18n("db_host")]);?>

        <?= $this->fetch('components::input',["type"=>"number","name"=>"db_port","label"=>$lang->i18n("db_port")]);?>

    </fieldset>


    <?= $this->fetch('components::button',["type"=>"submit","label"=>$lang->i18n("sendForm")]);?>


</form>
<script>

    (function() {

        var step1form =new FormElement("step-1-form",function (data,xhr) {

            window.location.href="?s=2";
        });

    })();

</script>

<?php  $this->stop()?>

