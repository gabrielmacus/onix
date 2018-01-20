<?php $this->layout('layout');  ?>

<?php $this->start('body') ?>

<?php
$headers=  (!empty($results))?array_keys(reset($results)):[];

$table = new \framework\modules\gui\table\model\TableComponent($headers,$results,$lang,
[FRAMEWORK_DIR."/modules/gui/table/view/table.css"] );
?>

<?= $table;?>


<?php $this->stop() ?>