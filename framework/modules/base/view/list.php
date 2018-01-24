<?php $this->layout('layout');  ?>

<?php $this->start('body') ?>

<?php
$table = new \framework\modules\gui\table\model\TableComponent($model,$results,$lang );
?>

<?= $table;?>


<?php $this->stop() ?>