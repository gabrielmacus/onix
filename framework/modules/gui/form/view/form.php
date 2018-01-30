<form <?= $this->loadExtraAttributes() ?> class="form" method="<?= $this->method ?>" enctype="<?= $this->enctype ?>" id="<?= $this->id ?>">

    <?php foreach ($this->formElementsArr as $element): ?>

        <?= $element ?>

    <?php endforeach ?>

</form>