<?php $this->layout("base::layout",["pageTitle"=>$lang->i18n("userConfirmedTitle")]);  ?>
<?php $this->start('body') ?>
<h2 class="confirmation-title"><?= $message ?></h2>
<p class="confirmation-text">
    <?= $confirmationText ?>
    <script>

        (
            function () {

                var i=0;

                setInterval(function () {




                    document.querySelector("#timeout").innerHTML = parseInt( document.querySelector("#timeout").innerHTML) -1;
                    /*
                     * {
                     "_id" : ObjectId("5a7c84edcb0b66b00f000029"),
                     "_type" : "framework\\modules\\user\\model\\User",
                     "username" : "gabrielmacus",
                     "password" : "$2y$10$NgXUS2reD4lw63ndk/gWCeZUQHIS2tCXOBwyzsEZESug0cqORZcTW",
                     "name" : "Gabriel",
                     "surname" : "Macus",
                     "email" : "gabrielmacus@gmail.com",
                     "superadmin" : "1",
                     "updated_at" : "",
                     "created_at" : "2018-02-08T17:12:07+0000",
                     "validation_code" : "143ba8cce1f4e59357ada5be86ae10fa",
                     "status" : 1
                     }*/
                    i++;

                    if(i==5)
                    {
                        window.location.href = "/";
                    }


                },1000)
            }
        )();

    </script>
</p>
<?php $this->end();?>