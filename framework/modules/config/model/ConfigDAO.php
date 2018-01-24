<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 24/01/2018
 * Time: 02:45 PM
 */

namespace framework\modules\config\model;


use framework\modules\base\model\Base;
use framework\modules\fileStorage\model\FileStorage;

class ConfigDAO extends FileStorage
{
    public function __construct()
    {
        parent::__construct(FRAMEWORK_DIR."/modules/config/config.json");
    }


    function beforeSave(&$base)
    {
        $base->validate();

        $base::CleanModel($base);

        $base::SetDefaultProperties($base);
    }

    function Create(Base &$base)
    {
        $this->beforeSave($base);

        parent::Create($base);
    }

    function Update(Base $base)
    {

        $this->beforeSave($base);

        parent::Update($base);
    }


}