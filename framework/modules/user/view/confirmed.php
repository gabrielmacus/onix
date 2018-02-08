<?php $this->layout("base::layout",["pageTitle"=>$lang->i18n("userConfirmedTitle")]);  ?>
<?php $this->start('body') ?>
<h2 class="confirmation-title"><?= $message ?></h2>
<p class="confirmation-text">
    <?= $confirmationText ?>
    <script>
        window.load=function () {

            var i=0;

            setInterval(function () {

                document.querySelector("#timeout").innerHTML = parseInt( document.querySelector("#timeout").innerHTML) -1;

                i++;

                if(i==5)
                {
                   window.location.href = "/";
                }


            },1000)

        }
    </script>
</p>
<?php $this->end();?>