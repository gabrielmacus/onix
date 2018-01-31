<div data-component="button" class="button-component <?= !(empty($type))?$this->e($type):"button" ?>">

    <button type="<?= !(empty($type))?$this->e($type):"button" ?>">
        <span class="button-label"><?= $this->e($label) ?></span>
        <?php if(!empty($type) && $type == 'submit'): ?>
        <span class="submit-loader"></span>
        <?php endif ?>
    </button>

</div>