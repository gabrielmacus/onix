<?php $this->layout('layout') ?>

<?php $this->start('body') ?>

    <table>
        <thead>

            <tr>
                <?Php
                foreach ($results['keys'] as $k=>$v)
                {
                    ?>
                    <th>
                        <?= $lang[$v]; ?>
                    </th>
                    <?php
                }
                ?>

            </tr>

        </thead>
        <tbody>

            <?Php
            foreach ($results['values'] as $k=>$v)
            {
                ?>
                <tr>
                    <?php
                    foreach ($v as $value)
                    {
                        ?>

                        <td><?= $value; ?></td>

                        <?php
                    }
                    ?>
                </tr>
                <?Php
            }
            ?>


        </tbody>
    </table>

<?php $this->stop() ?>