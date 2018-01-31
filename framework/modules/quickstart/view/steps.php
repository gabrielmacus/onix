<?php $this->layout("layout",$this->data);  ?>


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
            <p class="step-important-message">
                <?= $lang->i18n("stepImportantMessage") ?>
            </p>

        </div>

        <footer>
            <p>
                <?= $lang->i18n("stepNumber:{$this->e($stepNumber)}") ?>
            </p>
        </footer>

    </div>



<?php $this->stop() ?>



