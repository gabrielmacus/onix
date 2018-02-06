<?php $this->layout("steps",["title"=>$lang->i18n("superadminData"),"stepNumber"=>2,"pageTitle"=>$lang->i18n("superadminData")." - ".$lang->i18n("stepNumber:2")] + $this->data);  ?>

<?php $this->start('step-body') ?>

<form id="step-2-form" method="post" enctype="application/x-www-form-urlencoded" action="<?= "/api/quickstart?s=2" ?>">

    <?= \framework\modules\user\model\User::BuildForm($lang); ?>

    <?= $this->fetch('components::button',["type"=>"submit","label"=>$lang->i18n("sendForm")]);?>

</form>
<script>

    (function() {

        var step2form =new FormElement("step-2-form",function (data,xhr) {

            window.location.reload();
        });

    })();

</script>
<?php  $this->stop();?>
