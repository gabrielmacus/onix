<table>
    <thead>

    <tr>
        <?Php
        foreach ($this->thead as $k=>$v)
        {
            ?>
            <th>
                <?= $lang->i18n($v);?>
            </th>
            <?php
        }
        ?>

    </tr>

    </thead>
    <tbody>

    <?Php
    foreach ($this->tbody as $k=>$v)
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
