<?php $this->layout('layout') ?>

<?php $this->start('body') ?>

<?php
$headers=  array_keys(reset($results));
$table = new \framework\modules\gui\table\model\TableComponent($headers,$results,$lang);
?>

<?= $table;?>


<?php $this->stop() ?>