<?php
if(count($this->thead) >0 && count($this->tbody)> 0)
{
    ?>
    <table>
        <thead>

        <tr>
            <?Php
            foreach ($this->thead as $k=>$v)
            {
                ?>
                <th>
                    <?= $this->lang->i18n($v);?>
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

                    <td><?= (!empty($value))?$value:"-"; ?></td>

                    <?php
                }
                ?>
            </tr>
            <?Php
        }
        ?>


        </tbody>
    </table>

    <?php
}
else
{
    ?>
    <div class="no-results">
        <p>
            <?= $this->lang->i18n("noresults");?>
        </p>
    </div>
    <?php
}
?>