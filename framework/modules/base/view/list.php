<?php $this->layout('layout');  ?>

<?php $this->start('body') ?>

<?php
$headers=  array_keys(reset($results));
$table = new \framework\modules\gui\table\model\TableComponent($headers,$results,$lang,
["https://cdn.bootcss.com/stacktable.js/1.0.3/stacktable.min.css",FRAMEWORK_DIR."/modules/gui/table/view/table.css"],"https://cdn.bootcss.com/stacktable.js/1.0.3/stacktable.min.js");
?>

<?= $table;?>


<?php $this->stop() ?>