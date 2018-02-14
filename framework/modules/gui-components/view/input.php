
<div v-if="<?= (!empty($vIf)) ?$vIf:true ?>" :class="{ error: errors.<?= $prop?> }" data-component="input" class="form-component">

    <label><?= $label ?></label>

    <input  @keyup="cleanErrors('<?= $prop ?>')" @change="cleanErrors('<?= $prop ?>')"  v-model="<?= $modelName ?>.<?= $prop ?>"  type="<?= (!empty($type))?$this->e($type):'text'?>" >

    <template v-if="errors.<?= $prop ?>">

        <div  v-for="(v, k) in errors.<?= $prop ?>" class="validation-error">
            <p v-html="v.text"></p>
        </div>
    </template>



</div>