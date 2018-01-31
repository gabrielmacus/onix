
<div data-component="input" class="form-component">

    <label><?= $label ?></label>
    <input name="<?= $name ?>"  type="<?= (!empty($type))?$this->e($type):'text'?>" value="<?= (!empty($value))?$this->e($value):''?>" >

    <script type="text/template">
        <div class="validation-error">
            <p></p>
        </div>
    </script>


</div>