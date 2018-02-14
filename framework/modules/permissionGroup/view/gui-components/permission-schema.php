
<div v-if="<?= (!empty($vIf)) ?$vIf:true ?>" :class="{ error: errors.<?= $prop?> }" data-component="permission-schema" class="form-component">

    <label><?= $label ?></label>

    <div class="new-permission">
        <?= \framework\modules\permissionGroup\model\Permission::BuildForm($lang,0,null,[],'permission'); ?>
    </div>


    <ul v-if="typeof <?= $modelName ?>.<?= $prop ?> !== 'undefined' && <?= $modelName ?>.<?= $prop?>.length">
        <li v-for="(v,k) in <?= $modelName ?>.<?= $prop?>">
            {{v}}
        </li>
    </ul>

    <?= $this->fetch("components::button",["label"=>$lang->i18n("addPermission"),"type"=>"button"]) ?>


    <template v-if="errors.<?= $prop ?>">

        <div  v-for="(v, k) in errors.<?= $prop ?>" class="validation-error">
            <p v-html="v.text"></p>
        </div>
    </template>



</div>