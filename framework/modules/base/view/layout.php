<!doctype html>
<html lang="<?= \framework\services\LanguageService::detectLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= (!empty($pageTitle))?$this->e("{$pageTitle} - ".$configuration["app_name"]):$configuration["app_name"]; ?></title>
    <script src="<?= \framework\services\UrlService::Join($configuration["app_url"],"/static/js/submit.js")?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <link rel="stylesheet" href="<?= \framework\services\UrlService::Join($configuration["app_url"],"/static/css/common.css")?>">
</head>


<body   class="<?=  (!empty($bodyClass) && is_array($bodyClass))?implode(" ",$bodyClass):"" ?>">

    <section>
        <?= $this->section('body'); ?>
    </section>

</body>
</html>