<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 24/01/2018
 * Time: 02:45 PM
 */

namespace framework\modules\configuration\model;


use framework\modules\base\model\Base;
use framework\modules\fileStorage\model\FileStorageDAO;

class ConfigurationDAO extends FileStorageDAO
{
    public function __construct()
    {
        parent::__construct(FRAMEWORK_DIR."modules/configuration/config.json");
    }





}