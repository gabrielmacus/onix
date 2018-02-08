<?php $this->layout('layout');  ?>

<?php $this->start('body') ?>

    <h2><?= $lang->i18n("oopsError") ?></h2>

    <h3><?= $lang->i18n("pageErrorCode:{$code}")?></h3>

    <p><?=  $lang->i18n($error) ?></p>




<?php $this->stop() ?>