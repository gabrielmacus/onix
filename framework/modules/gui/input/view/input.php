<div class="form-element" id="<?= $this->id; ?>">

    <label><?= $this->lang->i18n($this->label); ?></label>
    <input <?= $this->loadExtraAttributes() ?> tabindex="<?= $this->tabindex ?>" type="<?= $this->type;  ?>">

</div>