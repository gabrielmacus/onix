<?php $this->layout('base::layout');  ?>

<?php $this->start('body') ?>

<form id="main-form" method="post" enctype="application/x-www-form-urlencoded" action="/api/<?= \framework\services\ModuleService::GetModule($ModelClass);?>">


    <?= $ModelClass::BuildForm($lang); ?>

    <?= $this->fetch('components::button',["type"=>"submit","label"=>$lang->i18n("sendForm")]);?>

</form>

<script>

    (function() {

        var mainForm =new FormElement("main-form");

    })();

</script>
<?php $this->stop() ?>


