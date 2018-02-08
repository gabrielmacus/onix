<!doctype html>
<html lang="<?= \framework\services\LanguageService::detectLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $lang->i18n("errorPageTitle")." - {$lang->i18n("pageErrorCode:{$code}")}" ?></title>
</head>


<body   class="<?=  (!empty($bodyClass) && is_array($bodyClass))?implode(" ",$bodyClass):"" ?>">

<section>
    <?= $this->section('body'); ?>
</section>

</body>
</html>