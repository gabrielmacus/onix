<div data-component="button" class="button-component">

    <button type="<?= !(empty($type))?$this->e($type):"button" ?>"><?= $this->e($label) ?></button>

</div>