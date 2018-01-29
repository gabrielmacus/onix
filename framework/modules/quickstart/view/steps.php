<?php $this->layout("base::layout",$this->data);  ?>


<?php $this->start('body') ?>


    <div class="welcome-text">

        <p>
          <?= $lang->i18n("quickstartWelcome"); ?>
        </p>

    </div>


    <div class="steps">

        <header>
            <h2><?=$this->e($title)?></h2>
        </header>


        <div class="body">
            <?= $this->section('step-body'); ?>
        </div>

        <footer>
            <p>
                <?= $lang->i18n("stepNumber:{$this->e($stepNumber)}") ?>
            </p>
        </footer>

    </div>



<?php $this->stop() ?>



