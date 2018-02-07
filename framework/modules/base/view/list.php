<?php $this->layout('base::layout');  ?>

<?php $this->start('body') ?>

<?php
$headers = (!empty($results))?array_keys(reset($results)):[];

?>


<?php $this->stop() ?>