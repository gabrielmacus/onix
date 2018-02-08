
<?php $this->layout("steps",["title"=>$lang->i18n("initialConfigData"),"stepNumber"=>1,"pageTitle"=>$lang->i18n("initialConfigData")." - ".$lang->i18n("stepNumber:1")]);  ?>


<?php $this->start('step-body') ?>

<form id="step-1-form" method="post" enctype="application/x-www-form-urlencoded" action="<?= "/api/quickstart" ?>">

    <fieldset form="step-1-form">

        <legend class="form-header"><?= $lang->i18n("applicationData");?></legend>
        <?= \framework\modules\configuration\model\Configuration::BuildForm($lang,2,1,['app_id']); ?>



    </fieldset>

    <fieldset form="step-1-form">

        <legend  class="form-header"><?= $lang->i18n("siteData")?></legend>

        <?= \framework\modules\configuration\model\Configuration::BuildForm($lang,5,2); ?>



    </fieldset>


    <fieldset form="step-1-form">
        <legend  class="form-header"><?= $lang->i18n("dbData");?></legend>

        <?= \framework\modules\configuration\model\Configuration::BuildForm($lang,7,5); ?>
    </fieldset>

    <fieldset form="step-1-form">

        <legend  class="form-header"><?= $lang->i18n("emailData"); ?></legend>

        <?= \framework\modules\configuration\model\Configuration::BuildForm($lang,12,6,['email_smtp_auth']); ?>


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

