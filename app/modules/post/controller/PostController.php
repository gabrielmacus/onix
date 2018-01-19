<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 06/01/2018
 * Time: 15:00
 */

namespace app\modules\post\controller;


use app\modules\post\lang\PostLang;
use app\modules\post\model\PostDAO;
use framework\modules\base\controller\BaseController;
use framework\modules\mongoConnection\model\MongoConnection;
use framework\services\LanguageService;

class PostController extends BaseController
{

    public function __construct($isApiCall = false)
    {
        $viewsFolder = APP_DIR."modules/post/view";

        //TODO: make use of $_ENV to set connection parameters
        $connection  = new MongoConnection("onix");

        $dao  = new PostDAO($connection);

        $language = new PostLang(LanguageService::detectLanguage());

        parent::__construct([$dao], $isApiCall,"app\\modules\\post\\model\\Post", $viewsFolder,$language);
    }


}