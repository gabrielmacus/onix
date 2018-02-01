
<div :class="{ error: errors.<?= empty($prop)?$name:$prop; ?> }" data-component="input" class="form-component">

    <label><?= $label ?></label>
    <input @keyup="cleanErrors('<?= empty($prop)?$name:$prop; ?>')" @change="cleanErrors('<?= empty($prop)?$name:$prop; ?>')" name="<?= $name ?>"  type="<?= (!empty($type))?$this->e($type):'text'?>" value="<?= (!empty($value))?$this->e($value):''?>" >

    <template v-if=" errors.<?= empty($prop)?$name:$prop; ?>">

        <div  v-for="(v, k) in errors.<?= empty($prop)?$name:$prop; ?>" class="validation-error">
            <p>{{v.text}}</p>
        </div>
    </template>



</div>