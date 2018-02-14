
<div v-if="<?= (!empty($vIf)) ?$vIf:true ?>" :class="{ error: errors.<?= $prop?> }" data-component="input" class="form-component">

    <label><?= $label ?></label>


    <select @keyup="cleanErrors('<?= $prop ?>')" @change="cleanErrors('<?= $prop ?>')"  v-model="<?= $modelName ?>.<?= $prop ?>"  >

        <option disabled value=""><?= $lang->i18n("selectAnOption")?></option>
        <?php foreach ($options as $value => $option):?>
            <option value="<?= $value?>"><?= $lang->i18n($option) ?></option>
        <?php endforeach; ?>
    </select>

    <template v-if="errors.<?= $prop ?>">

        <div  v-for="(v, k) in errors.<?= $prop ?>" class="validation-error">
            <p v-html="v.text"></p>
        </div>
    </template>



</div>